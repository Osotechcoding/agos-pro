<?php

use PHPMailer\PHPMailer\PHPMailer;

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
    $password = $this->Core->sanitise_string($data['login_password']);

    if ($this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($password)) {
    } elseif (!$this->Core->is_valid_email_address($email)) {
    } else {
      $sql = "SELECT * FROM `{$this->table}` WHERE email=?  =? LIMIT 1";
      $this->stmt = $this->dbh->prepare($sql);
      $this->stmt->execute([$email]);
      if ($this->stmt->rowCount() == '1') {
        //get the admin details
        $rows = $this->stmt->fetch();
        $db_password = $rows->password;
        //then check compare the passwords
        if ($this->Core->compareTwoHashedPasswords($password, $db_password)) {
          if (isset($data['remember_me']) && $data['remember_me'] === 'on') {
            //create and store login info to local storage
            @setcookie("staff_email", $email, time() + 604800, "/");
            // @setcookie("staff_pass", $password, time() + 604800, "/"); //store for 7 days
          } else {
            setcookie("staff_email", '', time() - 100, "/");
            //setcookie("staff_pass", '', time() - 100, "/");
          }
          $_SESSION['AGOS_STAFF_UNIQUE_TOKEN'] = $this->Core->generateRandomUserToken(35);
          $_SESSION['AGOS_STAFF_UNIQUE_ID'] = $rows->id;
          $_SESSION['AGOS_STAFF_UNIQUE_EMAIL'] = $rows->email;
          $_SESSION['AGOS_STAFF_UNIQUE_USERNAME'] = $rows->username;
          $_SESSION['AGOS_STAFF_UNIQUE_ROLE'] = $rows->role_type;

          $sql = "UPDATE `{$this->table}` SET is_online=1 WHERE id=? LIMIT 1";
          $this->stmt = $this->dbh->prepare($sql);
          if ($this->stmt->execute([$rows->id])) {
            $this->response = $this->Alert->flashMessage("AGOS Says", "Login successfully, Pls wait..!", "success", "top-right") . $this->Core->appRedirect("staff-dashboard");
          }
        } else {
          $this->response = $this->Alert->flashMessage("AGOS Says", "Account details not found!", "error", "top-right");
        }
      } else {
        $this->response = $this->Alert->flashMessage("AGOS Says", "Invalid login details!", "error", "top-right");
      }
    }
    return $this->response;
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
      $this->response = $this->Alert->flashMessage("AGOS Says", "Invalid submission, Pls check and try again!", "error", "top-right");
    } elseif (!$this->Core->is_valid_email_address($email)) {

      $this->response = $this->Alert->flashMessage("AGOS Says", "Invalid email address!", "error", "top-right");
    } else {
      //check if the email is already added
      if ($this->Core->userDataExisted($this->table, "email", $email)) {
        $this->response = $this->Alert->flashMessage("AGOS Says", "$email already taken!", "error", "top-right");
      } else {
        //try to insert ths new manager into database
        $status = 1;
        $verified = 1;
        $fullname = $first_name . " " . $last_name;
        $login_pass = $this->Core->generateRandomUserToken(12);
        //convert the random generated password to hash
        $hashed_pass = $this->Core->encryptUserPassword($login_pass);
        $exp_name = explode("@", $email);
        $username = $exp_name[0];
        $create_at = date("Y-m-d H:i:s");
        $link = "http://localhost/agos-pro/staff-login";
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
}