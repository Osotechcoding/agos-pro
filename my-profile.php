<?php
require_once "Helper/customerHelper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Profile Settings</title>
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/customerHeader.php" ?>

    <div class="page-container">

      <?php include_once "Inc/customerSidebar.php"; ?>

      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">User Profile</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./user-dashboard">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Extra</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">User Profile</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <!-- BEGIN PROFILE SIDEBAR -->
              <div class="profile-sidebar">
                <div class="card card-topline-aqua">
                  <div class="card-body no-padding height-9">
                    <div class="row">
                      <div class="profile-userpic">
                        <img src="assets/img/user-image.jpg" class="img-responsive" alt="">
                      </div>
                    </div>
                    <div class="profile-usertitle">
                      <div class="profile-usertitle-name"> <?php echo ucwords($customer_data->fullname) ?> </div>
                      <div class="profile-usertitle-job"> Member Since:
                        <?php echo date("M jS, Y", strtotime($customer_data->created_at)); ?> </div>
                      <div class="profile-usertitle-job"> <?php echo $customer_data->email; ?> </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-head card-topline-aqua">
                    <header>Address</header>
                  </div>
                  <div class="card-body no-padding height-9">
                    <div class="profile-desc">
                      <?php echo $customer_data->address; ?>
                    </div>
                    <ul class="list-group list-group-unbordered">

                      <li class="list-group-item">
                        <b>Gender </b>
                        <div class="profile-desc-item pull-right"><?php echo $customer_data->gender; ?></div>
                      </li>
                      <li class="list-group-item">
                        <b>State </b>
                        <div class="profile-desc-item pull-right"><?php echo $customer_data->state_of_origin; ?> </div>
                      </li>
                      <li class="list-group-item">
                        <b>Account Status </b>
                        <div class="profile-desc-item pull-right">
                          <span class="label label-success label-sm">Active</span>
                        </div>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>

              <div class="profile-content">
                <div class="row">
                  <!-- <div class="white-box">

                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="card-head">
                          <header>Account Settings</header>

                        </div>
                        <div class="card-body " id="bar-parent1">
                          <form id="customerUpdateDetailsForm">
                            <div class="form-group">
                              <label for="simpleFormPassword">Username
                              </label>
                              <input type="password" class="form-control form-control-lg" id="simpleFormPassword"
                                placeholder="Current Password">
                            </div>
                            <div class="form-group">
                              <label for="simpleFormEmail">Email </label>
                              <input type="text" class="form-control" id="simpleFormEmail"
                                placeholder="Enter Email name">
                            </div>

                            <div class="form-group">
                              <label for="newpassword">First Name</label>
                              <input type="password" class="form-control form-control-lg" id="newpassword"
                                placeholder="First Name">
                            </div>
                            <div class="form-group">
                              <label for="lastname">Last Name</label>
                              <input type="text" class="form-control form-control-lg" id="lastname"
                                placeholder="Last Name">
                            </div>
                            <div class="form-group">
                              <label for="lastname">Address</label>
                              <textarea name="address" class="form-control" id="" rows="2"></textarea>
                            </div>

                            <button type="submit" class="btn btn-dark">Submit Changes</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <div class="white-box">

                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="card-head">
                          <header>Password Change</header>
                        </div>

                        <div class="card-body" id="bar-parent1">
                          <form id="customerChangePasswordForm">
                            <div id="response" class="text-center mb-3"></div>
                            <div class="form-group">
                              <label for="current_pass">Current
                                Password</label>
                              <input type="password" autocomplete="off" name="current_pass"
                                class="form-control form-control-lg" id="current_pass" placeholder="Current Password">
                            </div>

                            <div class="form-group">
                              <label for="newpassword">New Password</label>
                              <input type="password" autocomplete="off" class="form-control form-control-lg"
                                name="newpassword" id="newpassword" placeholder="New Password">
                            </div>
                            <div class="form-group">
                              <label for="cnewpassword">Confirm New Password</label>
                              <input type="password" autocomplete="off" class="form-control form-control-lg"
                                id="cnewpassword" name="cnewpassword" placeholder="Confirm New Password">
                            </div>
                            <input type="hidden" name="action" value="update_my_acct_pass_">
                            <input type="hidden" name="uemail" value="<?php echo $customer_data->email; ?>">
                            <input type="hidden" name="uid" value="<?php echo $customer_data->id; ?>">
                            <button type="button" onclick="window.history.back()"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Back</button>
                            <button type="submit" class="btn btn-primary float-end _loadingBtn__">Save Changes</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PROFILE CONTENT -->
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php include_once "Inc/Footer.php"; ?>
    <!-- end footer -->
  </div>
  <?php include_once "Inc/FooterScript.php"; ?>
  <script>
  $(document).ready(function() {
    const PASSWORD_UPDATE_FORM = $("#customerChangePasswordForm");
    PASSWORD_UPDATE_FORM.on("submit", (e) => {
      e.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", PASSWORD_UPDATE_FORM.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Save Changes").attr("disabled", false);
          $("#response").html(res);
        }, 1000);
      })
    });
  })
  </script>

</body>

</html>