<?php
require_once "Mailer.php";

class Customer
{
  private PDO $dbh;
  protected $response;
  private $table = "customers";
  protected $Core;
  protected $stmt;
  protected $Alert;
  public function __construct($dbh, $Core, $Alert)
  {
    $this->dbh = $dbh;
    $this->Core = $Core;
    $this->Alert = $Alert;
  }

  public function login($data)
  {
    $email = $this->Core->sanitise_string($data['cemail']);
    $password = $this->Core->sanitise_string($data['cpass']);
    if ($this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($password)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Invalid Submission, Pls try again!", "danger");
    } elseif (!$this->Core->is_valid_email_address($email)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "$email is not a valid email address!", "danger");
    } else {
      $sql = "SELECT * FROM `{$this->table}` WHERE email=? LIMIT 1";
      $this->stmt = $this->dbh->prepare($sql);
      $this->stmt->execute([$email]);
      if ($this->stmt->rowCount() == '1') {
        //get the customer details
        $rows = $this->stmt->fetch();
        $db_password = $rows->password;
        //then compare the passwords
        if ($this->Core->compareTwoHashedPasswords($password, $db_password)) {
          if (isset($data['remember_me']) && $data['remember_me'] === 'on') {
            //create and store login info to local storage
            @setcookie("agos_customer_email", $email, time() + 604800, "/");
            @setcookie("agos_customer_pass", $password, time() + 604800, "/"); //store for 7 days
          } else {
            setcookie("agos_customer_email", '', time() - 100, "/");
            setcookie("agos_customer_pass", '', time() - 100, "/");
          }
          $_SESSION['AGOS_CUSTOMER_UNIQUE_TOKEN'] = $this->Core->generateRandomUserToken(50);
          $_SESSION['AGOS_CUSTOMER_UNIQUE_ID'] = $rows->id;
          $_SESSION['AGOS_CUSTOMER_UNIQUE_EMAIL'] = $rows->email;
          $_SESSION['AGOS_CUSTOMER_UNIQUE_USERNAME'] = $rows->username;
          $_SESSION['AGOS_CUSTOMER_VERIFIED_EMAIL'] = $rows->verified;
          if ($_SESSION['AGOS_CUSTOMER_VERIFIED_EMAIL'] == '1') {
            $sql = "UPDATE `{$this->table}` SET is_online=1 WHERE id=? LIMIT 1";
            $this->stmt = $this->dbh->prepare($sql);
            if ($this->stmt->execute([$rows->id])) {
              $this->response = $this->Alert->alertMessage("SUCCESS:", "Login Successfully, Pls wait...!", "success") . $this->Core->appRedirect("user-dashboard");
            }
          } else {
            $this->response = $this->Alert->alertMessage("NOTICE:", "This account is not Verified, Verification link was sent to <b> $email</b> Click the Link to verify your account!", "danger");
          }
        } else {
          $this->response = $this->Alert->alertMessage("WARNING:", "Account details not found!", "danger");
        }
      } else {
        $this->response = $this->Alert->alertMessage("WARNING:", "Invalid login details!", "danger");
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function walkInClientBooking(array $data)
  {
    $price = (float)$this->Core->sanitise_string($data['room_price']);
    $wallet_bal = (float)$this->Core->sanitise_string($data['cus_balance']);
    $room_id = $this->Core->sanitise_string($data['room_id']);
    $checkIn = $this->Core->sanitise_string(date("Y-m-d", strtotime($data['check_in_date'])));
    $checkOut =
      $this->Core->sanitise_string(date("Y-m-d", strtotime($data['check_out_date'])));
    $no_guest = $this->Core->sanitise_string($data['no_of_guest']);
    $no_child = $this->Core->sanitise_string($data['no_of_kids']) ?? "0";
    $comment = $this->Core->sanitise_string($data['comment']) ?? NULL;
    $cid = $this->Core->sanitise_string($data['customer_id']);
    //check for empty values
    if ($this->Core->isEmptyStr($room_id) || $this->Core->isEmptyStr($checkIn) || $this->Core->isEmptyStr($checkOut) || $this->Core->isEmptyStr($no_guest) || $this->Core->isEmptyStr($price) || $this->Core->isEmptyStr($cid) || $this->Core->isEmptyStr($wallet_bal)) {
      $this->response = $this->Alert->flashMessage("AGOS Says", "Invalid Submission, All feilds are required!", "error", "top-right");
    } else if ($price > $wallet_bal) {
      $this->response = $this->Alert->flashMessage("Notice:", "Your Wallet Balance is too Low for this booking, Please recharge your wallet and try again!", "error", "top-right");
    } else {
      //create all neccesary data needed for booking
      $customer_data = self::getCustomerById($cid);
      $ref_code = date("YmdHis") . mt_rand(1111111, 9999999) . date("dmY");
      $start_datetime = new DateTime($checkIn);
      $diff = $start_datetime->diff(new DateTime($checkOut));
      $no_of_nights = $diff->d;
      $booking_status = 1;
      $payment_method = "Wallet";
      $total_bill = (float)($price * $no_of_nights);
      if ($total_bill > $wallet_bal) {
        $this->response = $this->Alert->flashMessage("Notice:", "Wallet Balance is too Low for this reservation, Please recharge your wallet and try again!", "error", "top-right");
      } else {
        $time =  date("h:i:s");
        $created_at = date("Y-m-d");
        try {
          $this->dbh->beginTransaction();
          $sql = "INSERT INTO `booking_tbl` (customer_id,room_id,no_of_guest,no_of_children,checkIn,checkOut,`status`,ref_code,total_night,total_bill,payment_method,booking_time,comment,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
          $this->stmt = $this->dbh->prepare($sql);
          if ($this->stmt->execute([$cid, $room_id, $no_guest, $no_child, $checkIn, $checkOut, $booking_status, $ref_code, $no_of_nights, $total_bill, $payment_method, $time, $comment, $created_at])) {
            //update room to booked 
            $sql = "UPDATE `rooms_tbl` SET is_booked =? WHERE id=? LIMIT 1";
            $this->stmt = $this->dbh->prepare($sql);
            if ($this->stmt->execute([$booking_status, $room_id])) {
              //update customer wallet 
              $new_wallet_bal = (float)($wallet_bal - $total_bill);
              $sql = "UPDATE `wallet_tbl` SET balance =? WHERE customer_id=? LIMIT 1";
              $this->stmt = $this->dbh->prepare($sql);
              if ($this->stmt->execute([$new_wallet_bal, $cid])) {
                //send booking email to user
                if (sendReservationBookingInfoToCustomer($customer_data->fullname, $customer_data->email, $ref_code, $checkIn, $checkOut)) {
                  $this->dbh->commit();
                  $this->response = $this->Alert->flashMessage("SUCCESS:", "Reservation was Successful, Check your inbox at $customer_data->email for details!", "success", "top-right");
                }
              }
            }
          }
        } catch (PDOException $e) {
          $this->dbh->rollBack();
          $this->response =
            $this->response = $this->Alert->flashMessage("AGOS Says", "Internal Server Error: " . $e->getMessage(), "error", "top-right");
        }
      }
    }
    return $this->response;
    $this->dbh = null;
  }
  public function bookWithWalletCredit(array $data)
  {
    //!getSingleData();

    $price = (float)$this->Core->sanitise_string($data['room_price']);
    $wallet_bal = (float)$this->Core->sanitise_string($data['cus_balance']);
    $room_id = $this->Core->sanitise_string($data['room_id']);
    $checkIn = $this->Core->sanitise_string(date("Y-m-d", strtotime($data['check_in_date'])));
    $checkOut =
      $this->Core->sanitise_string(date("Y-m-d", strtotime($data['check_out_date'])));
    $no_guest = $this->Core->sanitise_string($data['no_of_guest']);
    $no_child = $this->Core->sanitise_string($data['no_of_kids']) ?? "0";
    $comment = $this->Core->sanitise_string($data['comment']) ?? NULL;
    $cid = $this->Core->sanitise_string($data['customer_id']);
    //check for empty values
    if ($this->Core->isEmptyStr($room_id) || $this->Core->isEmptyStr($checkIn) || $this->Core->isEmptyStr($checkOut) || $this->Core->isEmptyStr($no_guest) || $this->Core->isEmptyStr($price) || $this->Core->isEmptyStr($cid) || $this->Core->isEmptyStr($wallet_bal)) {
      $this->response = $this->Alert->flashMessage("AGOS Says", "Invalid Submission, All feilds are required!", "error", "top-right");
    } else if ($price > $wallet_bal) {
      $this->response = $this->Alert->flashMessage("Notice:", "Your Wallet Balance is too Low for this booking, Please recharge your wallet and try again!", "error", "top-right");
    } else {
      //create all neccesary data needed for booking
      $customer_data = self::getCustomerById($cid);
      $ref_code = date("YmdHis") . mt_rand(1111111, 9999999) . date("dmY");
      $start_datetime = new DateTime($checkIn);
      $diff = $start_datetime->diff(new DateTime($checkOut));
      $no_of_nights = $diff->d;
      $booking_status = 1;
      $payment_method = "Wallet";
      $total_bill = (float)($price * $no_of_nights);
      if ($total_bill > $wallet_bal) {
        $this->response = $this->Alert->flashMessage("Notice:", "Wallet Balance is too Low for this reservation, Please recharge your wallet and try again!", "error", "top-right");
      } else {
        $time =  date("h:i:s");
        $created_at = date("Y-m-d");
        try {
          $this->dbh->beginTransaction();
          $sql = "INSERT INTO `booking_tbl` (customer_id,room_id,no_of_guest,no_of_children,checkIn,checkOut,`status`,ref_code,total_night,total_bill,payment_method,booking_time,comment,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
          $this->stmt = $this->dbh->prepare($sql);
          if ($this->stmt->execute([$cid, $room_id, $no_guest, $no_child, $checkIn, $checkOut, $booking_status, $ref_code, $no_of_nights, $total_bill, $payment_method, $time, $comment, $created_at])) {
            //update room to booked 
            $sql = "UPDATE `rooms_tbl` SET is_booked =? WHERE id=? LIMIT 1";
            $this->stmt = $this->dbh->prepare($sql);
            if ($this->stmt->execute([$booking_status, $room_id])) {
              //update customer wallet 
              $new_wallet_bal = (float)($wallet_bal - $total_bill);
              $sql = "UPDATE `wallet_tbl` SET balance =? WHERE customer_id=? LIMIT 1";
              $this->stmt = $this->dbh->prepare($sql);
              if ($this->stmt->execute([$new_wallet_bal, $cid])) {
                //send booking email to user
                if (sendReservationBookingInfoToCustomer($customer_data->fullname, $customer_data->email, $ref_code, $checkIn, $checkOut)) {
                  $this->dbh->commit();
                  $this->response = $this->Alert->flashMessage("SUCCESS:", "Reservation was Successful, Check your inbox at $customer_data->email for details!", "success", "top-right");
                }
              }
            }
          }
        } catch (PDOException $e) {
          $this->dbh->rollBack();
          $this->response =
            $this->response = $this->Alert->flashMessage("AGOS Says", "Internal Server Error: " . $e->getMessage(), "error", "top-right");
        }
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function register(array $data)
  {
    if (is_array($data)) {
      if (array_key_exists('agos_tokens', $data)) {
        $email = $this->Core->sanitise_string($data['email']);
        $fname = $this->Core->sanitise_string($data['first_name']);
        $lname = $this->Core->sanitise_string($data['last_name']);
        $phone = $this->Core->sanitise_string($data['mobile']);
        $gender = $this->Core->sanitise_string($data['gender']);
        $address = $this->Core->sanitise_string($data['address']);
        $city = $this->Core->sanitise_string($data['city_state']);
        $agos_token = $this->Core->sanitise_string($data['agos_tokens']);
        //check for empty values
        if ($this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($fname)) {
          $this->response = $this->Alert->flashMessage("AGOS Says", "Invalid Submission, All feilds are required!", "error", "top-right");
        } else if (!$this->Core->is_valid_email_address($email)) {
          $this->response = $this->Alert->flashMessage("AGOS Says", "Your email Address is Not valid!", "error", "top-right");
        } else if ($this->Core->userDataExisted("customers", "email", $email)) {
          $this->response = $this->Alert->flashMessage("AGOS Says", "$email already exists", "error", "top-right");
        } else {
          //create all the neccesary details
          $account_bonus = (float)(30000.00); //N30,000.00 
          $verification_code = $this->Core->generateRandomUserToken(100);
          $login_pass = $this->Core->generateRandomUserToken(8);
          //convert the random generated password to hash
          $hashed_pass = $this->Core->encryptUserPassword($login_pass);
          $fullName = $fname . " " . $lname;
          $status = 0;
          $verified = 0;
          $exp_name = explode("@", $email);
          $username = $exp_name[0];
          $created_at = date("Y-m-d");
          $link = "http://localhost/agos-pro/account-activation?email=$email&token=$verification_code&user=new-customer";
          $tokenExp = date("Y-m-d H:i:s", strtotime("+ 10 days"));
          //!link expires in 10 days
          //let create the user table 
          try {
            $this->dbh->beginTransaction();
            $sql = "INSERT INTO `customers` (fullname,email,`password`,username,verified,`address`,phone,gender,state_of_origin,confirmation_code,tokenExp,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
            $this->stmt = $this->dbh->prepare($sql);
            //check if the details saved
            if ($this->stmt->execute([$fullName, $email, $hashed_pass, $username, $verified, $address, $phone, $gender, $city, $verification_code, $tokenExp, $created_at])) {
              //grab the last insert Id 
              $newClientId = $this->dbh->lastInsertId();
              $last_recharge_date = date("Y-m-d H:i:s");
              //let create the customers wallet 
              $status = 1;
              $query = "INSERT INTO `wallet_tbl` (customer_id,balance,last_recharge_date,`status`,created_at) VALUES (?,?,?,?,?);";
              $this->stmt = $this->dbh->prepare($query);
              if ($this->stmt->execute([$newClientId, $account_bonus, $last_recharge_date, $status, $created_at])) {
                if (sendConfirmationEmailToNewCustomer($fname . $lname, $email, $login_pass, $tokenExp, $link) == 'Sent') {
                  $this->response = $this->Alert->flashMessage("AGOS Says", "Customer Registration was successful, activation mail was sent to $email. Click the link on the message to activate your account!", "success", "top-right") . $this->Core->pageReload();
                  $this->dbh->commit();
                }
              }
            }
          } catch (PDOException $e) {
            $this->dbh->rollBack();
            $this->response =
              $this->response = $this->Alert->flashMessage("AGOS Says", "Internal Server Error: " . $e->getMessage(), "error", "top-right");
          }
        }
      } else {
        $this->response = $this->Alert->flashMessage("AGOS Says", "Unauthorized Access !", "error", "top-right");
      }

      return $this->response;
      $this->dbh = null;
    }
  }
  public function logout($cid)
  {
  }

  public function isCustomerLoggedIn()
  {
    if (!isset($_SESSION['AGOS_CUSTOMER_UNIQUE_ID']) && !isset($_SESSION['AGOS_CUSTOMER_UNIQUE_EMAIL']) || $_SESSION['AGOS_CUSTOMER_UNIQUE_ID'] === "" || $_SESSION['AGOS_CUSTOMER_UNIQUE_EMAIL'] === "") {
      $this->Core->destroy('login');
    }
  }

  public function getAllCustomers()
  {
    $sql = "SELECT * FROM `{$this->table}` ORDER BY id DESC LIMIT 1000";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getCustomerById($cid)
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE id=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute([$cid]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getCustomerWalletDetailsById($cid)
  {
    $sql = "SELECT * FROM `wallet_tbl` WHERE customer_id=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute([$cid]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getCustomerWalletRechargeHistoryById($cid)
  {
    $sql = "SELECT * FROM `recharge_history` WHERE customer_id=? ORDER BY id DESC LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute([$cid]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function handleCustomerLogout($cid)
  {
    $cid = $this->Core->sanitise_string($cid);
    if (!$this->Core->isEmptyStr($cid)) {
      $sql = "UPDATE `{$this->table}` SET is_online=0 WHERE id=? LIMIT 1";
      $this->stmt = $this->dbh->prepare($sql);
      if ($this->stmt->execute([$cid])) {
        $this->Core->destroy("login");
      }
    }
  }

  public function countAllCustomers()
  {
    $sql = "SELECT count(id) as customer FROM `{$this->table}`";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response->customer;
      $this->dbh = null;
    }
  }

  public function getRecentCustomerRegistration()
  {
    $sql = "SELECT * FROM `{$this->table}` ORDER BY created_at DESC LIMIT 5";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function activateUserAccountViaEmail($url_email, $url_token)
  {
    $token = $this->Core->sanitise_string($url_token);
    $email = $this->Core->sanitise_string($url_email);
    //check all the params if not empty
    if ($this->Core->isEmptyStr($token) || $this->Core->isEmptyStr($email)) {
      $this->response = $this->Core->appRedirect("login");
    } else {
      $sql_query = "SELECT * FROM `{$this->table}` WHERE email=? AND `confirmation_code`=? AND `tokenExp`> NOW() LIMIT 1";
      $this->stmt = $this->dbh->prepare($sql_query);
      $this->stmt->execute([$email, $token]);
      if ($this->stmt->rowCount() == '1') {
        //activate the account
        $sql = "UPDATE `{$this->table}` SET `verified`=1,`confirmation_code`='' WHERE email=? AND `confirmation_code`=? LIMIT 1";
        $this->stmt = $this->dbh->prepare($sql);
        if ($this->stmt->execute([$email, $token])) {
          $this->response = $this->Alert->alertMessage("SUCCESS:", "Email account verification successful. Click <a href='http://localhost/agos-pro/login'>Here</a> to login if you are not redirect within 5 Seconds!", "success") . $this->Core->accountActivationRedirect("login");
        }
      } else {
        $this->response = $this->Core->appRedirect("login");
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function updateMyPassword($data)
  {
    $cid = $this->Core->sanitise_string($data['uid']);
    $email = $this->Core->sanitise_string($data['uemail']);
    $old_pass = $this->Core->sanitise_string($data['current_pass']);
    $pass = $this->Core->sanitise_string($data['newpassword']);
    $cpass = $this->Core->sanitise_string($data['cnewpassword']);
    if ($this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($cid) || $this->Core->isEmptyStr($old_pass) || $this->Core->isEmptyStr($pass) || $this->Core->isEmptyStr($cpass)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Invalid Submission", "danger");
    } else if (strlen($pass) <= 6) {
      $this->response =  $this->Alert->alertMessage("WARNING:", "Password should be atleast seven character long!", "danger");
    } else if ($pass !== $cpass) {
      $this->response = $this->Alert->alertMessage("WARNING:", "The two password do not match!", "danger");
    } else {
      //get customer data from db via cid
      $customer_data = $this->getCustomerById($cid);
      $db_password = $customer_data->password;
      if (!$this->Core->compareTwoHashedPasswords($old_pass, $db_password)) {
        $this->response = $this->Alert->alertMessage("WARNING:", "Your old account password is Incorrect!", "danger");
      } else {
        //update the password and log the user out
        try {
          $this->dbh->beginTransaction();
          $hashed_pass = $this->Core->encryptUserPassword($pass);
          $sql_update = "UPDATE `{$this->table}` SET `password`=? WHERE id=? AND email=? LIMIT 1";
          $this->stmt = $this->dbh->prepare($sql_update);
          if ($this->stmt->execute([$hashed_pass, $cid, $email])) {
            $this->dbh->commit();
            $this->response = $this->Alert->alertMessage("SUCCESS:", "Account Password updated successfully, Pls wait...", "success") . "<script>
    setTimeout(() => {
      window.location.href = 'logout?action=customer-logout';
    }, 3500);
    </script>";
          }
        } catch (PDOException $e) {
          $this->dbh->rollBack();
          $this->response =
            $this->response = $this->Alert->alertMessage("SERVER ERROR", "Internal Server Error: " . $e->getMessage(), "danger");
        }
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function sendCustomerPasswordResetLink($data)
  {
    $email = $this->Core->sanitise_string($data['link_email']);
    if ($this->Core->isEmptyStr($email)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Your email address is required!", "danger");
    } elseif (!$this->Core->is_valid_email_address($email)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Invalid email address!", "danger");
    } else {
      //check user details via email
      $sql = "SELECT * FROM `{$this->table}` WHERE email=? LIMIT 1";
      $this->stmt = $this->dbh->prepare($sql);
      $this->stmt->execute([$email]);
      if ($this->stmt->rowCount() == '1') {
        //get details 
        $customer_data = $this->stmt->fetch();
        $reset_token = $this->Core->generateRandomUserToken(62);
        $link = "http://localhost/agos-pro/reset-password?email=$email&reset-token=$reset_token&user=customer";
        try {
          $this->dbh->beginTransaction();
          $query = "UPDATE `{$this->table}` SET `reset_token`=? WHERE email=? LIMIT 1";
          $this->stmt = $this->dbh->prepare($query);
          if ($this->stmt->execute([$reset_token, $email])) {
            if (sendCustomerPasswordResetLinkViaEmail($customer_data->fullname, $email, $link)) {
              $this->dbh->commit();
              $this->response = $this->Alert->alertMessage("SUCCESS:", "Password reset link was sent to <b>$email</b>. Click on the Link to reset your password!", "success");
            }
          }
        } catch (PDOException $e) {
          $this->dbh->rollBack();
          $this->response =
            $this->response = $this->Alert->alertMessage("SERVER ERROR", "Internal Server Error: " . $e->getMessage(), "danger");
        }
      } else {
        $this->response = $this->Alert->alertMessage("WARNING:", "No account associated with this $email!", "danger");
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function resetCustomerPassword($data)
  {
    $email = $this->Core->sanitise_string($data['email']);
    $pass = $this->Core->sanitise_string($data['new_pass']);
    $cpass = $this->Core->sanitise_string($data['cnew_pass']);
    if ($this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($pass) || $this->Core->isEmptyStr($cpass)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Invalid Submission", "danger");
    } else if (strlen($pass) <= 6) {
      $this->response =  $this->Alert->alertMessage("WARNING:", "Password should be atleast seven (7) characters long!", "danger");
    } else if ($pass !== $cpass) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Password and Confirm password do not match!", "danger");
    } else {
      //update the password and log the user out
      try {
        $this->dbh->beginTransaction();
        $hashed_pass = $this->Core->encryptUserPassword($pass);
        $sql_update = "UPDATE `{$this->table}` SET `password`=? WHERE `email`=? LIMIT 1";
        $this->stmt = $this->dbh->prepare($sql_update);
        if ($this->stmt->execute([$hashed_pass, $email])) {
          $this->dbh->commit();
          $this->response = $this->Alert->alertMessage("SUCCESS:", "Password updated successfully, Redirecting...", "success") . "<script>
    setTimeout(() => {
      window.location.href = 'login';
    }, 3500);
    </script>";
        }
      } catch (PDOException $e) {
        $this->dbh->rollBack();
        $this->response = $this->response = $this->Alert->alertMessage("SERVER ERROR", "Internal Server Error: " . $e->getMessage(), "danger");
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function verifiedResetTokenAndEmail($email, $token)
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE `email`=? AND `reset_token`=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$email, $token]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = true;
    } else {
      $this->response = false;
    }
    return $this->response;
    $this->dbh = null;
  }

  public function delete($data)
  {
    try {
      $id = $this->Core->sanitise_string($data['custId']);
      $this->dbh->beginTransaction();
      $this->stmt = $this->dbh->prepare("DELETE FROM `{$this->table}` WHERE id=? LIMIT 1");
      if ($this->stmt->execute([$id])) {
        $this->dbh->commit();
        $this->response = $this->Alert->flashMessage("SUCCESS", "Customer Deleted Successfully!", "success", "top-right") . $this->Core->pageReload();
      }
    } catch (PDOException $e) {
      $this->dbh->rollback();
      $this->response = $this->Alert->flashMessage("ERROR", "Something went wrong!: " . $e->getMessage(), "error", "top-right");
    }
    return $this->response;
    $this->dbh = null;
  }
}