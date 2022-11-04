<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta name="description" content="Responsive Admin Template" />
  <meta name="author" content="SmartUniversity" />
  <title>Sign up form</title>
  <!-- icons -->
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="assets/plugins/iconic/css/material-design-iconic-font.min.css">
  <!-- bootstrap -->
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- style -->
  <link rel="stylesheet" href="assets/css/pages/extra_pages.css">
  <!-- favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.ico" />
</head>

<body>
  <div class="limiter">
    <div class="container-login100 page-background">
      <div class="wrap-login100">
        <form class="login100-form validate-form">

          <span class="login100-form-title p-b-34 p-t-2">
            Sign Up
          </span>
          <div class="row">
            <div class="col-lg-6 p-t-20">
              <div class="wrap-input100 validate-input" data-validate="Enter First Name">
                <input class="input100" type="text" name="first_name" placeholder="First Name">
                <span class="focus-input100" data-placeholder="&#xf207;"></span>
              </div>
            </div>
            <div class="col-lg-6 p-t-20">
              <div class="wrap-input100 validate-input" data-validate="Enter Last Name">
                <input class="input100" type="text" name="last_name" placeholder="Last Name">
                <span class="focus-input100" data-placeholder="&#xf207;"></span>
              </div>
            </div>
            <div class="col-lg-6 p-t-20">
              <div class="wrap-input100 validate-input" data-validate="Enter Email address">
                <input class="input100" type="text" name="email" placeholder="Email">
                <span class="focus-input100" data-placeholder="&#9993;"></span>
              </div>
            </div>
            <div class="col-lg-6 p-t-20">
              <div class="wrap-input100 validate-input" data-validate="Enter Phone">
                <input class="input100" type="number" name="mobile" placeholder="Phone">
                <span class="focus-input100" data-placeholder="&#x1f4f1;"></span>
              </div>
            </div>

            <div class="col-lg-6 p-t-20">
              <div class="wrap-input100 validate-input" data-validate="Enter Address">
                <input class="input100" type="text" name="address" placeholder="Address">
                <span class="focus-input100" data-placeholder="&#8962;"></span>
              </div>
            </div>
            <div class="col-lg-6 p-t-20">
              <div class="wrap-input100 validate-input" data-validate="Enter email">
                <select name="gender" id="gender" class="input100">
                  <option value="">Male</option>
                  <option value="">Female</option>
                </select>

              </div>
            </div>

            <div class="col-lg-6 p-t-20">
              <div class="wrap-input100 validate-input" data-validate="Enter password">
                <input class="input100" type="password" name="pass" placeholder="Password">
                <span class="focus-input100" data-placeholder="&#xf191;"></span>
              </div>
            </div>
            <div class="col-lg-6 p-t-20">
              <div class="wrap-input100 validate-input" data-validate="Enter password again">
                <input class="input100" type="password" name="pass2" placeholder="Confirm password">
                <span class="focus-input100" data-placeholder="&#xf191;"></span>
              </div>
            </div>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn _loadingBtn__" type="submit">
              Create Account
            </button>
          </div>
          <div class="text-center p-t-60 mt-3">
            <a class="txt1" href="login">
              You already have an account?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- bootstrap -->
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/pages/extra_pages/login.js"></script>

</body>

</html>