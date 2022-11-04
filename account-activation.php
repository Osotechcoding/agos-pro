<?php
require_once "App/Model/Database.php";
spl_autoload_register(function ($class_def) {
  require "App/Controller/" . $class_def . ".php";
});

$Database = new Database();
$dbh = $Database->osotech_connect();
$Alert = new Alert();
$Core = new Core($dbh, $Alert);
$Customer = new Customer($dbh, $Core, $Alert);
$Core->osotech_session();
$request_method = $_SERVER['REQUEST_METHOD'];
$result = "";
if ($request_method === "GET") {
  if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];
    $result = $Customer->activateUserAccountViaEmail($email, $token);
  } else {
    echo "<script>window.location.href='login';</script>";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Account Activation</title>
  <!-- icons -->
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="assets/plugins/iconic/css/material-design-iconic-font.min.css">
  <!-- bootstrap -->
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- style -->
  <link rel="stylesheet" href="assets/css/pages/extra_pages.css">
  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png" />
</head>

<body>
  <div class="limiter">
    <div class="container-login100 page-background">
      <div class="card">
        <div class="card-body">
          <div class="col-md-6 offset-3">
            <h6 class="text-center"><?php if (isset($result) && !empty($result)) {
                                      echo $result;
                                    } ?></h6>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- start js include path -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- bootstrap -->
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>