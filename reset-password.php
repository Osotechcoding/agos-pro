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
  if (isset($_GET['email']) && isset($_GET['reset-token']) && $_GET['email'] != "" && $_GET['reset-token'] != "") {
    $email = $Core->sanitise_string($_GET['email']);
    $token = $Core->sanitise_string($_GET['reset-token']);
    if ($Customer->verifiedResetTokenAndEmail($email, $token)) {
      $user_email = $email;
    } else {
      echo "<script>window.location.href='login';</script>";
      exit;
    }
  } else {
    echo "<script>window.location.href='login';</script>";
    exit;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Forgot Password Link</title>
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
      <div class="wrap-login100">
        <form class="login100-form validate-form" id="passwordupdateForm">
          <span class="login100-form-title p-b-34 p-t-27">
            Create New Password
          </span>
          <div class="form-group mt-3 mb-3">
            <div id="response" class="text-center mt-1"></div>
            <input type="hidden" name="action" value="update_forgot_pwd_now">
            <input autocomplete="off" class="form-control form-control-lg mb-3" type="text" name="email" readonly
              value="<?php echo $user_email; ?>">
          </div>
          <div class="form-group">
            <input autocomplete="off" class="form-control form-control-lg mb-3" type="text" name="new_pass"
              placeholder="Enter Password">
          </div>
          <div class="form-group">
            <input autocomplete="off" class="form-control form-control-lg mb-3" type="text" name="cnew_pass"
              placeholder="Enter Confirm Password">
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn _loadingBtn__" type="submit">
              Send Reset Link
            </button>
          </div>
          <div class="text-center p-t-40 mt-3" style="font-size: 22px;">
            <a class="txt1" href="./login">
              Sign-In Here?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- bootstrap -->
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function() {
    const formData = $("#passwordupdateForm");
    formData.on("submit", (event) => {
      event.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", formData.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Sign In").attr("disabled", false);
          $("#response").html(res);
        }, 1000);
      })
    });
  });
  </script>
</body>

</html>