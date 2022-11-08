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

  public function getAppInfo()
  {
    $sql = "SELECT * FROM `tbl_settings` WHERE id=1 LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
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
      $admin_data = $this->getAdminById($cid);
      $db_password = $admin_data->password;
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
      window.location.href = './logout?action=destroy_admin_session';
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

  public function updateAppSettings($data, $file)
  {
    $company = $this->Core->sanitise_string($data['company']);
    $phone = $this->Core->sanitise_string($data['phone']);
    $email = $this->Core->sanitise_string($data['email']);
    $address = $this->Core->sanitise_string($data['address']);
    $state = $this->Core->sanitise_string($data['state']);
    $website = $this->Core->sanitise_string($data['website']);
    $owner = $this->Core->sanitise_string($data['founder_name']);
    $founde_year = $this->Core->sanitise_string($data['established_at']);

    $logo_name = $file['logo']['name'];

    //check for empty values
    if ($this->Core->isEmptyStr($company) || $this->Core->isEmptyStr($phone) || $this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($address) || $this->Core->isEmptyStr($state) || $this->Core->isEmptyStr($logo_name) || $this->Core->isEmptyStr($owner) || $this->Core->isEmptyStr($founde_year) || $this->Core->isEmptyStr($website)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Invalid Submission, Pls check your input!", "danger");
    } else if (!$this->Core->is_valid_email_address($email)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Please enter a valid email address!", "danger");
    } else {
      $logo_tmp = $file['logo']['tmp_name'];
      $logo_size = $file['logo']['size'] / 1024;

      $accepted  = ["jpeg", "png", "jpg"];
      $img_exp = explode(".", $logo_name);
      $ext = strtolower(end($img_exp));
      if (!in_array($ext, $accepted)) {
        $this->response = $this->Alert->alertMessage("WARNING:", "Only JPEG, PNG and  JPG Extension is allowed!", "danger");
      } else if ($logo_size > 100) {
        $this->response = $this->Alert->alertMessage("WARNING:", "Max: file size cannot exceed 100KB!", "danger");
      } else {
        $image_name = "agos_" . time() . "." . $ext;
        $destination = "../../image/" . $image_name;
        try {
          $this->dbh->beginTransaction();
          $id = 1;
          $sql = "UPDATE `tbl_settings` SET company_name=?,phone=?,email=?,`address`=?,`state`=?,logo=?,`url`=?,`owner`=?,founded_year=? WHERE id=? LIMIT 1";
          $this->stmt = $this->dbh->prepare($sql);
          if ($this->stmt->execute([$company, $phone, $email, $address, $state, $image_name, $website, $owner, $founde_year, $id])) {
            if ($this->Core->move_file_to_folder($logo_tmp, $destination)) {
              $this->dbh->commit();
              $this->response = $this->Alert->alertMessage("SUCCESS:", "Application Info Updated successfully!", "success") . $this->Core->pageReload();
            }
          }
        } catch (PDOException $e) {
          $this->dbh->rollBack();
          $this->response = $this->Alert->alertMessage("SERVER ERROR", "Internal Server Error: " . $e->getMessage(), "danger");
        }
      }
    }
    return $this->response;
    $this->dbh = null;
  }
}