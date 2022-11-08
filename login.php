<?php require_once "Helper/loginHelper.php"; ?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title><?php echo ucwords($app_data->company_name); ?> || Customer Login</title>
  <?php include_once "Inc/LoginHeaderScript.php"; ?>
  <!-- icons -->

</head>

<body>
  <div class="limiter">
    <div class="container-login100 page-background">
      <div class="wrap-login100">
        <h3 class="text-center text-warning mb-2"><?php echo ucwords($app_data->company_name); ?></h3>
        <form class="login100-form validate-form" id="customerLoginForm">
          <span class="login100-form-title p-b-34 p-t-27">
            CUSTOMER LOGIN
          </span>
          <span id="response" class="text-center mt-2"></span>
          <input type="hidden" name="action" value="customer_login_form_submit__">
          <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input class="input100" type="text" name="cemail" placeholder=" Email">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
          </div>
          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="cpass" placeholder="Password">
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
          <div class="text-center p-t-40 mt-3">
            <a class="txt1" href="forgot-password">
              Forgot Password?
            </a>
          </div>
          <div class="text-center p-t-40 mt-3 text-warning">
            Don't have an account? <a class="txt1 ml-1" href="signup">
              Create account
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
    const formData = $("#customerLoginForm");
    formData.on("submit", (event) => {
      event.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", formData.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Sign In").attr("disabled", false);
          $("#response").html(res);
        }, 1000);
      })
      //8oQybvAi
    });

  })
  </script>
</body>

</html>