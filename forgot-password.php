<!DOCTYPE html>
<html>

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>AGO's Hotel</title>
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
        <form class="login100-form validate-form" id="passwordResetForm">
          <span class="login100-form-title p-b-34 p-t-27">
            Forgot Password
          </span>
          <h6 class="text-white">Enter your email, reset link will be sent to your inbox</h6>
          <span id="response" class="text-center mt-3 text-lowercase"></span>
          <input type="hidden" name="action" value="send_forgot_pwd_link">
          <div class="wrap-input100 validate-input" data-validate="Enter username">
            <input autocomplete="off" class="input100" type="text" name="link_email" placeholder=" Email">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
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
  <!-- start js include path -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- bootstrap -->
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <!-- send_forgot_pwd_link -->
  <script>
  $(document).ready(function() {
    const formData = $("#LoginFormData");
    formData.on("submit", (event) => {
      event.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", formData.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Sign In").attr("disabled", false);
          $("#response").html(res);
        }, 1000);
      })

    })

    var showPass = 0;
    $('.btn-show-pass').on('click', function() {
      if (showPass == 0) {
        $(this).next('input').attr('type', 'text');
        $(this).addClass('active');
        showPass = 1;
      } else {
        $(this).next('input').attr('type', 'password');
        $(this).removeClass('active');
        showPass = 0;
      }

    });
  })
  </script>
</body>

</html>