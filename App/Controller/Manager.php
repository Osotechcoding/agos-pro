<?php

class Manager
{
  private PDO $dbh;
  private $table = "staff_tbl";
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
    $email = $this->Core->sanitise_string($data['login_email']);
    $password = $this->Core->sanitise_string($data['login_pass']);

    if ($this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($password)) {
      $this->response = $this->Alert->alertMessage("WARNING", "Login details are required!", "danger");
    } elseif (!$this->Core->is_valid_email_address($email)) {
      $this->response = $this->Alert->alertMessage("WARNING", "Invalid email address!", "danger");
    } else {
      $sql = "SELECT * FROM `{$this->table}` WHERE email=? LIMIT 1";
      $this->stmt = $this->dbh->prepare($sql);
      $this->stmt->execute([$email]);
      if ($this->stmt->rowCount() == '1') {
        $rows = $this->stmt->fetch();
        $db_password = $rows->password;
        //then check compare the passwords
        if ($this->Core->compareTwoHashedPasswords($password, $db_password)) {
          if (isset($data['remember_me']) && $data['remember_me'] === 'on') {
            //create and store login info to local storage
            @setcookie("staff_email", $email, time() + 604800, "/");
          } else {
            setcookie("staff_email", '', time() - 100, "/");
          }
          $_SESSION['AGOS_STAFF_UNIQUE_TOKEN'] = $this->Core->generateRandomUserToken(35);
          $_SESSION['AGOS_STAFF_UNIQUE_ID'] = $rows->id;
          $_SESSION['AGOS_STAFF_UNIQUE_EMAIL'] = $rows->email;
          $_SESSION['AGOS_STAFF_UNIQUE_USERNAME'] = $rows->username;
          $_SESSION['AGOS_STAFF_UNIQUE_ROLE'] = $rows->role_type;
          if ($rows->status == '0') {
            $this->response = $this->Alert->alertMessage("NOTICE:", "This account has been suspended, contact your Admin Officer!", "danger");
          } else {
            $sql = "UPDATE `{$this->table}` SET is_online=1 WHERE id=? LIMIT 1";
            $this->stmt = $this->dbh->prepare($sql);
            if ($this->stmt->execute([$rows->id])) {
              $this->response = $this->Alert->alertMessage("SUCCESS", "Login successfully, Pls wait..!", "success") . $this->Core->appRedirect("staff-dashboard");
            }
          }
        } else {
          $this->response = $this->Alert->alertMessage("WARNING", "Account details not found!", "danger");
        }
      } else {
        $this->response = $this->Alert->alertMessage("WARNING", "Invalid login details!", "danger");
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function register($data)
  {
    $first_name = $this->Core->sanitise_string($data['first_name']);
    $last_name = $this->Core->sanitise_string($data['last_name']);
    $email = $this->Core->sanitise_string($data['email']);
    $phone = $this->Core->sanitise_string($data['mobile']);
    $address = $this->Core->sanitise_string($data['address']);
    $role_type = $this->Core->sanitise_string($data['role']);
    $gender = $this->Core->sanitise_string($data['gender']);
    $city = $this->Core->sanitise_string($data['city']);

    if (
      $this->Core->isEmptyStr($email) ||
      $this->Core->isEmptyStr($first_name) ||
      $this->Core->isEmptyStr($last_name) ||
      $this->Core->isEmptyStr($phone) ||
      $this->Core->isEmptyStr($address) ||
      $this->Core->isEmptyStr($role_type) ||
      $this->Core->isEmptyStr($city) ||
      $this->Core->isEmptyStr($gender)
    ) {
      $this->response = $this->Alert->flashMessage("WARNING", "Invalid submission, Pls check and try again!", "error", "top-right");
    } elseif (!$this->Core->is_valid_email_address($email)) {

      $this->response = $this->Alert->flashMessage("WARNING", "Invalid email address!", "error", "top-right");
    } else {
      //check if the email is already added
      if ($this->Core->userDataExisted($this->table, "email", $email)) {
        $this->response = $this->Alert->flashMessage("WARNING", "$email already taken!", "error", "top-right");
      } else {
        //try to insert ths new manager into database
        $status = 1;
        $verified = 1;
        $fullname = $first_name . " " . $last_name;
        $login_pass = $this->Core->generateRandomUserToken(12);
        //convert the random generated password to hash
        $hashed_pass = $this->Core->encryptUserPassword($login_pass);
        $username = $last_name;
        $create_at = date("Y-m-d H:i:s");
        $link = $this->Core->web_root() . "staff-login";
        $token = $this->Core->generateRandomUserToken(34);
        try {
          $this->dbh->beginTransaction();
          $sql = "INSERT INTO `{$this->table}` (username,email,`password`,fullname,role_type,`status`,verified,`address`,gender,state_of_origin,phone,account_token,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
          $this->stmt = $this->dbh->prepare($sql);
          if ($this->stmt->execute([$username, $email, $hashed_pass, $fullname, $role_type, $status, $verified, $address, $gender, $city, $phone, $token, $create_at])) {
            //send login details to manager email 
            if (sendLoginDetailEmailToNewStaff($fullname, $email, $login_pass, $role_type, $link)) {
              $this->response = $this->Alert->flashMessage("AGOS Says", "Staff Registration was successful, Login details was sent to $email. !", "success", "top-right") . $this->Core->pageReload();
              $this->dbh->commit();
            }
          }
        } catch (PDOException $e) {
          $this->dbh->rollBack();
          $this->response = $this->Alert->flashMessage("AGOS Says", " Unknown Server Error Occured: " . $e->getMessage(), "error", "top-right");
        }
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function handleStaffLogOut($mId)
  {
    $mId = $this->Core->sanitise_string($mId);
    $sql = "UPDATE `{$this->table}` SET is_online=0 WHERE id=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    if ($this->stmt->execute([$mId])) {
      $this->Core->destroy('staff-login');
    }
  }

  public function isStaffLoggedIn()
  {
    if (!isset($_SESSION['AGOS_STAFF_UNIQUE_ID']) && !isset($_SESSION['AGOS_STAFF_UNIQUE_EMAIL']) || $_SESSION['AGOS_STAFF_UNIQUE_ID'] === "" || $_SESSION['AGOS_STAFF_UNIQUE_EMAIL'] === "") {
      $this->Core->destroy('staff-login');
    }
  }

  public function getAllStaff()
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

  public function getStaffById($sid)
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE id=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute([$sid]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function countAllStaff()
  {
    $sql = "SELECT count(id) as staff FROM `{$this->table}`";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response->staff;
      $this->dbh = null;
    }
  }

  public function suspendStaff($data)
  {
    try {
      $id = $this->Core->sanitise_string($data['staffId']);
      $action = $this->Core->sanitise_string($data['action']);
      switch ($action) {
        case 'Suspend':
          $status = "0";
          $status_text = "Suspended";
          break;
        case 'Unsuspend':
          $status = "1";
          $status_text = "Unsuspended";
          break;

        default:
          $status = "1";
          $status_text = "Unsuspended";
          break;
      }
      $this->dbh->beginTransaction();
      $this->stmt = $this->dbh->prepare("UPDATE `{$this->table}` SET `status`=? WHERE id=? LIMIT 1");
      if ($this->stmt->execute([$status, $id])) {
        $this->dbh->commit();
        $this->response = $this->Alert->flashMessage("SUCCESS", "Staff $status_text Successfully!", "success", "top-right") . $this->Core->pageReload();
      }
    } catch (PDOException $e) {
      $this->dbh->rollback();
      $this->response = $this->Alert->flashMessage("ERROR", "Something went wrong!: " . $e->getMessage(), "error", "top-right");
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
      $staff_data = $this->getStaffById($cid);
      $db_password = $staff_data->password;
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
      window.location.href = './logout?action=staff-logout';
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
}