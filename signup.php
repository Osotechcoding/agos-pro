<!DOCTYPE html>
<html>

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
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
  <style>
  label {
    color: #fff;
    font-size: 17px;
  }

  .form-group {
    margin-bottom: 3px !important;
  }
  </style>
</head>

<body>
  <div class="limiter">
    <div class="container-login100 page-background">
      <div class="wrap-login100">
        <h3 class="text-center text-warning mb-2">AGOS HOTEL</h3>
        <h4 class="text-center text-white mb-3">Customer Registration Form</h4>
        <form class="login100-form validate-form" id="customerSignUpForm">
          <div class="row">
            <span id="response" class="text-center mt-2"></span>
            <input type="hidden" name="action" value="submit_new_customer_reg_">
            <div class="col-lg-6 p-t-20">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="">First Name</label>
                  <input type="text" autocomplete="off" class="form-control" name="first_name"
                    placeholder="Enter first name">
                </div>
              </div>
            </div>
            <div class="col-lg-6 p-t-20">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="">Last Name</label>
                  <input type="text" autocomplete="off" class="form-control" name="last_name"
                    placeholder="Enter last name">
                </div>
              </div>
            </div>
            <div class="col-lg-12 p-t-20">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="">Email</label>
                  <input type="text" autocomplete="off" class="form-control" name="email"
                    placeholder="Enter email address">
                </div>
              </div>
            </div>
            <div class="col-lg-12 p-t-20">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="">Phone</label>
                  <input type="number" autocomplete="off" class="form-control" name="mobile" placeholder="Enter Phone">
                </div>
              </div>
            </div>
            <div class="col-lg-6 p-t-20">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="">Gender</label>
                  <select name="gender" id="gender" class="custom-select form-control">
                    <option value="">Choose...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6 p-t-20">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="city_state">State of Origin</label>
                  <select class="form-select input-height" name="city_state">
                    <option value="">Select...</option>
                    <option value="Abia State">Abia State</option>
                    <option value="Adamawa State">Adamawa State</option>
                    <option value="Akwa Ibom State">Akwa Ibom State</option>
                    <option value="Anambra State">Anambra State</option>
                    <option value="Bauchi State">Bauchi State</option>
                    <option value="Bayelsa State">Bayelsa State</option>
                    <option value="Benue State">Benue State</option>
                    <option value="Borno State">Borno State</option>
                    <option value="Cross River State">Cross River State</option>
                    <option value="Delta State">Delta State</option>
                    <option value="Ebonyi State">Ebonyi State</option>
                    <option value="Edo State">Edo State</option>
                    <option value="Ekiti State">Ekiti State</option>
                    <option value="Enugu State">Enugu State</option>
                    <option value="FCT">FCT</option>
                    <option value="Gombe State">Gombe State</option>
                    <option value="Imo State">Imo State</option>
                    <option value="Jigawa State">Jigawa State</option>
                    <option value="Kaduna State">Kaduna State</option>
                    <option value="Kano State">Kano State</option>
                    <option value="Katsina State">Katsina State</option>
                    <option value="Kebbi State">Kebbi State</option>
                    <option value="Kogi State">Kogi State</option>
                    <option value="Kwara State">Kwara State</option>
                    <option value="Lagos State">Lagos State</option>
                    <option value="Nasarawa State">Nasarawa State</option>
                    <option value="Niger State">Niger State</option>
                    <option value="Ogun State">Ogun State</option>
                    <option value="Ondo State">Ondo State</option>
                    <option value="Osun State">Osun State</option>
                    <option value="Oyo State">Oyo State</option>
                    <option value="Plateau State">Plateau State</option>
                    <option value="Rivers State">Rivers State</option>
                    <option value="Sokoto State">Sokoto State</option>
                    <option value="Taraba State">Taraba State</option>
                    <option value="Yobe State">Yobe State</option>
                    <option value="Zamfara State">Zamfara State</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-12 p-t-20">
              <div class="form-group">
                <div class="col-md-12">
                  <label for="address">Residence Address</label>
                  <textarea autocomplete="off" class="form-control" name="address" rows="2"
                    placeholder="Enter first name"></textarea>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="agos_tokens" value="<?php echo md5("agos_access_code") . mt_rand(1111, 9999); ?>">
          <div class="container-login100-form-btn mt-2">
            <button class="login100-form-btn _loadingBtn__" type="submit">
              Create Account
            </button>
          </div>
          <div class="text-center p-t-40 mt-2">
            <a class="txt1" href="./login">
              already have an account?
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
    const fd = $("#customerSignUpForm");
    fd.on("submit", (event) => {
      event.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", fd.serialize(), (res) => {
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