<?php require_once "Helper/helper.php"; ?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta name="description" content="Responsive Admin Template" />
  <meta name="author" content="SmartUniversity" />
  <title>Edit Staff Details</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/Header.php" ?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/TopSidebar.php"; ?>
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Edit Staff Details</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="javascript:void(0);">Staff</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Edit</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="card card-box">
                <div class="card-head">
                  <header class="text-center m-4">
                    <h2> Edit Staff Details</h2>
                  </header>
                  <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                    data-upgraded=",MaterialButton">
                    <i class="material-icons">more_vert</i>
                  </button>
                  <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    data-mdl-for="panel-button">
                    <li class="mdl-menu__item"><a href="#"><i class="fa fa-eye"> </i> View Staff</a>
                    </li>


                  </ul>
                </div>
                <div class="card-body" id="bar-parent">
                  <form id="saveEditedStaffForm" class="form-horizontal">
                    <div class="form-body">
                      <div class="form-group row">
                        <label class="control-label col-md-3">First Name
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" autocomplete="off" name="first_name" data-required="1"
                            placeholder="enter first name" class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Last Name
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" autocomplete="off" name="last_name" data-required="1"
                            placeholder="enter last name" class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Email
                        </label>
                        <div class="col-md-6">
                          <div class="input-group">

                            <input type="text" class="form-control input-height" autocomplete="off" name="email"
                              placeholder="Enter active email address">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Mobile No.
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input autocomplete="off" name="mobile" type="text" placeholder="mobile number"
                            class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Gender
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <select class="form-select input-height" name="gender">
                            <option value="">Select...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row mt-3">
                        <label class="control-label col-md-3">Home Address
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <textarea name="address" placeholder="address" class="form-control-textarea"
                            rows="4"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">State of Origin
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <select class="form-select input-height" name="city_state">
                            <option value="" selected>Lagos State</option>
                            <?php echo $Core->getAllStatesInDropDownList(); ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">Designation
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <select class="form-select input-height" name="role">
                            <option value="">Select Designation...</option>
                            <option value="Manager">Manager</option>
                            <option value="Receptionist">Receptionist</option>
                            <option value="Cleaner">Cleaner</option>
                            <option value="Security">Security</option>
                            <option value="Chef">Chef</option>
                          </select>
                        </div>
                      </div>

                      <input type="hidden" name="action" value="submit_updated_staff_details">
                      <input type="hidden" name="agos_tokens" value="2289484748448">
                      <div class="form-actions">
                        <div class="row">
                          <div class="offset-md-3 col-md-9">
                            <button type="submit"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary btn-lg _loadingBtn__">Submit</button>
                            <button type="reset"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- start footer -->
    <?php include_once "Inc/Footer.php"; ?>
    <!-- end footer -->
  </div>
  <?php include_once "Inc/FooterScript.php"; ?>
  <script>
  $(document).ready(function() {
    const formData = $("#saveEditedStaffForm");
    formData.on("submit", (e) => {
      e.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", formData.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Submit").attr("disabled", false);
          console.log(res);
          $("#server-response").html(res);
        }, 1000);
      })
    });
  })
  </script>
</body>

</html>