<?php

class Admin
{
  private PDO $dbh;
  private $table = "admin_tbl";
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
    $email = $this->Core->sanitise_string($data['admin_email']);
    $password = $this->Core->sanitise_string($data['admin_pass']);
    if ($this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($password)) {
      $this->response = $this->Alert->alertMessage("WARNING", "Invalid Submission, Pls try again!", "danger");
    } elseif (!$this->Core->is_valid_email_address($email)) {
      $this->response = $this->Alert->alertMessage("WARNING", "$email is not a valid email address!", "danger");
    } else {
      $sql = "SELECT * FROM `{$this->table}` WHERE email=? LIMIT 1";
      $this->stmt = $this->dbh->prepare($sql);
      $this->stmt->execute([$email]);
      if ($this->stmt->rowCount() == '1') {
        //get the admin details
        $rows = $this->stmt->fetch();
        $db_password = $rows->password;
        //then compare the passwords
        if ($this->Core->compareTwoHashedPasswords($password, $db_password)) {
          if (isset($data['remember_me']) && $data['remember_me'] === 'on') {
            //create and store login info to local storage
            @setcookie("agos_admin_email", $email, time() + 604800, "/");
          } else {
            setcookie("agos_admin_email", '', time() - 100, "/");
          }
          $_SESSION['AGOS_ADMIN_UNIQUE_TOKEN'] = $this->Core->generateRandomUserToken(50);
          $_SESSION['AGOS_ADMIN_UNIQUE_ID'] = $rows->id;
          $_SESSION['AGOS_ADMIN_UNIQUE_EMAIL'] = $rows->email;
          $_SESSION['AGOS_ADMIN_UNIQUE_USERNAME'] = $rows->username;
          $_SESSION['AGOS_ADMIN_UNIQUE_ROLE'] = $rows->role_type;
          $sql = "UPDATE `{$this->table}` SET is_online=1 WHERE id=? LIMIT 1";
          $this->stmt = $this->dbh->prepare($sql);
          if ($this->stmt->execute([$rows->id])) {
            $this->response = $this->Alert->alertMessage("SUCCESS", "Login successful, Please wait...", "success") . $this->Core->appRedirect("./");
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

  public function handleAdminLogOut($adminId)
  {
    $adminId = $this->Core->sanitise_string($adminId);
    if (!$this->Core->isEmptyStr($adminId)) {
      $sql = "UPDATE `{$this->table}` SET is_online=0 WHERE id=? LIMIT 1";
      $this->stmt = $this->dbh->prepare($sql);
      if ($this->stmt->execute([$adminId])) {
        $this->Core->destroy("adminlogin");
      }
    }
  }

  public function isAdminLoggedIn()
  {
    if (!isset($_SESSION['AGOS_ADMIN_UNIQUE_ID']) && !isset($_SESSION['AGOS_ADMIN_UNIQUE_EMAIL']) || $_SESSION['AGOS_ADMIN_UNIQUE_ID'] === "" || $_SESSION['AGOS_ADMIN_UNIQUE_EMAIL'] === "") {
      $this->Core->destroy("adminlogin");
    }
  }

  public function getAdminById($aid)
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE id=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute([$aid]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }
}