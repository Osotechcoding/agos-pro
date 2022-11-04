<?php
class Core
{
  private PDO $dbh;
  protected $response;
  protected $stmt;
  protected $Alert;
  public function __construct($dbh, $Alert)
  {
    // check if .php exists in our url and redirect the user to 404 page
    if (substr($_SERVER['REQUEST_URI'], -4) == ".php" or (stripos($_SERVER['REQUEST_URI'], ".php") == true)) {
      self::redirect_root("page-404");
    }
    $this->dbh = $dbh;
    $this->Alert = $Alert;
  }

  public function osotech_session()
  {
    if (version_compare(phpversion(), '5.4.0', '<')) {
      if (session_id() == '') {
        @session_start();
      }
    } else {
      if (session_status() == PHP_SESSION_NONE) {
        @session_start();
      }
    }
  }

  public function greetUser(): string
  {

    $time = date("H");
    if ($time >= 0 && $time <= 12) {
      $this->response = "Good Morning";
    } else if ($time > 12 && $time <= 16) {
      $this->response = "Good Afternoon";
    } else if ($time > 16 && $time <= 24) {
      $this->response = "Good Evening";
    } else {
      $this->response = "Good Night";
    }
    return $this->response;
  }

  public static function web_root(): string
  {
    return "http://localhost/agos-pro/";
  }

  public static function redirect_root($flink)
  {
    header("Location: " . self::web_root() . $flink);
    exit();
  }

  public function sanitise_string($string)
  {
    if (!self::isEmptyStr($string)) {
      $string = trim($string);
      $string = strip_tags($string);
      $string = htmlspecialchars($string);
      $string = stripcslashes($string);
      $string = htmlentities($string);
      return $string;
    } else {
      return "";
    }
  }

  public function isEmptyStr($str): bool
  {
    return ($str === "" || empty($str)) ? true : false;
  }
  //String Conversion
  public function osotech_encryption($action, $string): string
  {
    $this->response = "";
    $Encrypt_method = "AES-256-CBC";
    $Secret_key = "ilovemywifeoiza!@iremidesomuch@!)";
    $Secret_iv = "ilovemywifeoiza!";
    $key = hash('sha256', $Secret_key);
    $initialization_vector = substr(hash('sha256', $Secret_iv), 0, 16);

    if (!self::isEmptyStr($string)) {
      //check the type of action
      if ($action == "code") {
        // encrypt string
        $this->response = openssl_encrypt($string, $Encrypt_method, $key, 0, $initialization_vector);
        $this->response = base64_encode($this->response);
      }
      if ($action == "decode") {
        // code...
        $this->response = base64_decode($string);
        $this->response = openssl_decrypt($this->response, $Encrypt_method, $key, 0, $initialization_vector);
      }
    }
    return $this->response;
  }

  public function getAppConfigData()
  {
    $query = "SELECT * FROM `tbl_settings` WHERE `id`=1 LIMIT 1";
    $this->stmt = $this->dbh->prepare($query);
    $this->response = $this->stmt->execute();
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getSingleData($table, $field, $value)
  {
    $query = "SELECT * FROM `{$table}` WHERE `{$field}`=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($query);
    $this->response = $this->stmt->execute([$value]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function encryptUserPassword($password): string
  {
    if (!self::isEmptyStr($password)) {
      $this->response = password_hash($password, PASSWORD_DEFAULT);
      return $this->response;
    }
  }
  public function is_valid_email_address($email): bool
  {
    return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
  }
  public function is_valid_password($password): bool
  {
    $this->response = preg_match_all('$S*(?=S{8,})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$', $password);
    return ($this->response == true) ? true : false;
  }

  public function move_file_to_folder($filename, $destination): bool
  {
    $this->response = move_uploaded_file($filename, $destination) ? true : false;
    return $this->response;
  }

  public function destroy($url)
  {
    if (@session_destroy()) {
      self::redirect_root($url);
      exit();
    }
  }

  public function compareTwoHashedPasswords($password, $db_password): bool
  {
    $this->response = password_verify($password, $db_password);
    return ($this->response) ? true : false;
  }
  public function compareTwoPasswords($password, $confirm_password): bool
  {
    return ($password === $confirm_password) ? true : false;
  }

  function saltifyString($string): string
  {
    return urlencode(base64_encode($string));
  }

  function unsaltifyString($string): string
  {
    return base64_decode(urldecode($string));
  }

  public function getAppLogo()
  {
    $AppDetails = self::getAppConfigData();
    $AppLogo = $AppDetails->app_logo;
    if ($AppLogo == NULL || $AppLogo == "") {
      $ourLogo = self::web_root() . "image/agos-logo.png";
    } else {
      $ourLogo = self::web_root() . "image/" . $AppLogo;
    }
    $this->response = $ourLogo;
    return $this->response;
  }

  public function generateRandomUserToken($len)
  {
    $this->response = "";
    $stringCode = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $stringCode .= "abcdefghijklmnopqrstuvwxyz";
    $stringCode .= "1234567890";
    $keyMax = strlen($stringCode);
    $Str = str_shuffle($stringCode);
    for ($i = 0; $i < $len; $i++) {
      // code...
      $this->response .= $Str[random_int(0, $keyMax - 1)];
    }
    return $this->response;
  }

  public function appRedirect($path)
  {
    return '<script>
    setTimeout(()=>{
      window.location.href="' . $path . '"
    },1000);
          </script>';
  }

  public function accountActivationRedirect($path)
  {
    return '<script>
    setTimeout(()=>{
      window.location.href="' . $path . '"
    },7000);
          </script>';
  }

  public function pageReload()
  {
    return '<script>
    setTimeout(()=>{
      window.location.reload();
    },3000);
          </script>';
  }

  public function userDataExisted($table, $field, $val): bool
  {
    $sql = "SELECT * FROM `{$table}` WHERE `{$field}`=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$val]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = true;
    } else {
      $this->response = false;
    }
    return $this->response;
    $this->dbh = null;
  }

  public function getAllStatesInDropDownList()
  {
    $this->response = "";
    $this->stmt = $this->dbh->prepare("SELECT * FROM `state_tbl` ORDER BY name ASC");
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      while ($row = $this->stmt->fetch()) {
        $this->response .= '<option value="' . $row->name . '">' . $row->name . '</option>';
      }
    }
    return $this->response;
    $this->dbh = null;
  }
}