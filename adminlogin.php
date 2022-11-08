<?php require_once "Helper/loginHelper.php"; ?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title><?php echo ucwords($app_data->company_name); ?> || Admin Login</title>
  <?php include_once "Inc/LoginHeaderScript.php"; ?>
</head>

<body>
  <div class="limiter">
    <div class="container-login100 page-background">
      <div class="wrap-login100">
        <h3 class="text-center text-warning mb-2"><?php echo ucwords($app_data->company_name); ?></h3>
        <form class="login100-form validate-form" id="adminAuthLoginForm">

          <span class="login100-form-title p-b-34 p-t-27">
            ADMIN LOGIN
          </span>
          <span id="response" class="text-center mt-3"></span>
          <input type="hidden" name="action" value="auth_admin_login_form_submit__">
          <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input autocomplete="off" class="input100" type="text" name="admin_email" placeholder=" Email">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
          </div>
          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" autocomplete="off" type="password" name="admin_pass" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
          </div>
          <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember_me">
            <label class="label-checkbox100" for="ckb1">
              Remember me
            </label>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn _loadingBtn__" type="submit">
              Sign In
            </button>
          </div>
          <div class="text-center p-t-40 mt-3 text-warning">
            Powered by: <a class="txt1 ml-1" href="<?php echo ($app_data->url); ?>">
              <?php echo ($app_data->short_name); ?>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- start js include path -->
  <?php include_once "Inc/LoginFooterScript.php"; ?>
  <script>
  $(document).ready(function() {
    const formData = $("#adminAuthLoginForm");
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
  })
  </script>
</body>

</html>