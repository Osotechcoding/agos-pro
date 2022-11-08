<?php
require_once "Helper/helper.php";

?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title><?php echo ucwords($app_data->company_name) ?> || Profile Settings</title>
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/Header.php" ?>

    <div class="page-container">

      <?php include_once "Inc/TopSidebar.php"; ?>

      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title"><?php echo $admin_data->fullname; ?>'s Profile</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#"><?php echo $admin_data->fullname; ?></a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li class="active"> Profile</li>
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
                        <img class="img-circle" width="50" height="120" src="assets/img/user-image.jpg"
                          class="img-responsive" alt="">
                      </div>
                    </div>
                    <div class="profile-usertitle">
                      <div class="profile-usertitle-name"> <?php echo ucwords($admin_data->fullname) ?> </div>
                      <div class="profile-usertitle-job"> Admin Since:
                        <?php echo date("M jS, Y", strtotime($admin_data->created_at)); ?> </div>
                      <div class="profile-usertitle-job"> <?php echo $admin_data->email; ?> </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body no-padding height-9">
                    <ul class="list-group list-group-unbordered">
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
                  <div class="white-box">
                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="card-head">
                          <header>Company Info Settings</header>
                        </div>
                        <div class="card-body" id="bar-parent1">

                          <form id="appDetailsForm" enctype="multipart/form-data">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <input type="hidden" name="action" value="update_company_info_details_">
                                  <label for="company">Company Name
                                  </label>
                                  <input type="text" autocomplete="off" class="form-control form-control-lg"
                                    name="company" value="<?php echo ucwords($app_data->company_name) ?>">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="email"> Email </label>
                                  <input type="email" autocomplete="off" class="form-control" name="email"
                                    value="<?php echo ($app_data->email) ?>">
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">

                                  <label for="newpassword"> Phone</label>
                                  <input type="number" autocomplete="off" class="form-control form-control-lg"
                                    name="phone" value="<?php echo ($app_data->phone) ?>">
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="lastname"> Address</label>
                                  <textarea name="address" class="form-control" id="" rows="3"
                                    placeholder="Enter Company Address"><?php echo ucwords($app_data->address) ?></textarea>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">

                                  <label for="state">State</label>
                                  <select class="form-select form-control input-height" name="state">
                                    <option value="">Select...</option>
                                    <option value="<?php echo ucwords($app_data->state) ?>" selected>
                                      <?php echo ucwords($app_data->state) ?></option>
                                    <?php echo $Core->getAllStatesInDropDownList(); ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">

                                  <label for="lastname">Webiste Url</label>
                                  <input type="text" autocomplete="off" class="form-control form-control-lg"
                                    name="website" value="<?php echo ($app_data->url) ?>">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="lastname">Founded Year</label>
                                  <input type="date" autocomplete="off" class="form-control form-control-lg"
                                    name="established_at" value="<?php echo ($app_data->founded_year) ?>">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="lastname">Founded By</label>
                                  <input type="text" autocomplete="off" class="form-control form-control-lg"
                                    name="founder_name" value="<?php echo ucwords($app_data->owner) ?>">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-md-12 col-12">
                                <input type="file" onchange="previewFile(this)" autocomplete="off"
                                  class="form-control form-control-lg" name="logo" id="logo-image">
                                <span class="text-danger">Image type must be jpg or png. Max: 100KB</span>
                                <div class="col-md-6">

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <img id="previewImg" width="200" height="200"
                                        src="image/<?php echo $app_data->logo == NULL || $app_data->logo == "" ? 'agos-logo.jpg' : $app_data->logo; ?>"
                                        alt="Placeholder" style="border: 5px solid tomato;border-radius:10px;">
                                      <p>Selected File Size: <span id="ImageSize"></span></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-circle btn-lg _loadingBtn____">Save
                              Changes</button>
                          </form>
                          <div id="osotech_response" class="text-center mb-3 mt-2"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="white-box">

                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="card-head">
                          <header>Password Reset Form</header>
                        </div>
                        <div class="card-body" id="bar-parent1">
                          <form id="adminChangePasswordForm">
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
                            <input type="hidden" name="action" value="update_admin_acct_pass_">
                            <input type="hidden" name="uemail" value="<?php echo $admin_data->email; ?>">
                            <input type="hidden" name="uid" value="<?php echo $admin_data->id; ?>">
                            <button type="button" onclick="window.history.back()"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Back</button>
                            <button type="submit" class="btn btn-info btn-circle float-end _loadingBtn__">Save
                              Changes</button>
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
    const PASSWORD_UPDATE_FORM = $("#adminChangePasswordForm");
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
    //update app details
    $("#appDetailsForm").on("submit", function(e) {
      e.preventDefault();
      $("._loadingBtn____").html("Loading...").attr("disabled", true);
      $.ajax({
        url: "App/Controller/Actions",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend() {
          $("._loadingBtn__").html(
            'Loading...').attr("disabled",
            true);
        },
        success: function(data) {
          setTimeout(() => {
            console.log(data);
            $("._loadingBtn____").html('Save Changes').attr("disabled", false);

            $("#osotech_response").html(data);

          }, 1500);
        }

      });
    });
  });



  function previewFile(input) {
    var file = $("#logo-image").get(0).files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function() {
        $("#previewImg").attr("src", reader.result);
        //$("#imagename").html(file.name);
        $("#ImageSize").html((file.size / 1024).toFixed(2) + "KB");
      }
      reader.readAsDataURL(file);
    }
  }
  </script>

</body>

</html>