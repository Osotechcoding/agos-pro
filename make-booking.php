<?php require_once "Helper/staffHelper.php"; ?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Add Room</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/staffHeader.php" ?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/staffSidebar.php"; ?>
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Manage New Booking</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="javascript:void(0);">Add Booking</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li class="active">Add Booking</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="card card-box">
                <div class="card-head">
                  <header class="text-center m-4">
                    <h2>Room & Customer's Information</h2>
                  </header>


                </div>
                <div class="card-body" id="bar-parent">
                  <form id="walkInBookingForm" class="form-horizontal">
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
                              placeholder="Email Address">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Mobile No.
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input name="mobile" autocomplete="off" type="number" placeholder="mobile number"
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
                      <div class="form-group row">
                        <label class="control-label col-md-3"> Address
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <textarea name="address" placeholder="Permanent Address" class="form-control"
                            rows="3"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">State of Origin
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <select class="form-select input-height" name="city_state">
                            <option value="">Select...</option>
                            <?php echo $Core->getAllStatesInDropDownList(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Check-In Date
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <div class="input-append date">
                            <div id="dateIcon" class="input-group datePicker">
                              <input class="formDatePicker form-control" type="text" name="check_in_date"
                                placeholder="Select Check-In Date.." data-input>
                              <span class="dateBtn">
                                <a class="input-button" title="toggle" data-toggle>
                                  <i class="icon-calendar"></i>
                                </a>
                                <a class="input-button" title="clear" data-clear>
                                  <i class="icon-close"></i>
                                </a>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label class="control-label col-md-3">Check-Out Date
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <div class="input-append date">
                            <div id="dateIcon2" class="input-group datePicker">
                              <input class="formDatePicker form-control" type="text" name="check_out_date"
                                placeholder="Select Check-Out Date.." data-input>
                              <span class="dateBtn">
                                <a class="input-button" title="toggle" data-toggle>
                                  <i class="icon-calendar"></i>
                                </a>
                                <a class="input-button" title="clear" data-clear>
                                  <i class="icon-close"></i>
                                </a>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Select Room
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <select class="form-select input-height" name="room_type">
                            <option value="">Select...</option>
                            <?php echo $Room->getAllRoomsInDropDownList(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">No of Guest
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input name="no_of_guest" autocomplete="off" type="number" min="1" max="5"
                            placeholder="No of Guest" class="form-control input-height" />
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">No of Children
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input name="no_of_kids" placeholder="No of Children" type="number" autocomplete="off"
                            type="number" min="0" max="5" class="form-control input-height" />
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">Comment
                        </label>
                        <div class="col-md-6">
                          <textarea name="comment" class="form-control" placeholder="Comment" rows="3"></textarea>
                        </div>
                      </div>
                      <input type="hidden" name="action" value="walkin_booking_form_submited_via_staff">
                      <input type="hidden" name="agos_token" value="2289484748448">
                      <input type="hidden" name="booked_by" value="<?php echo $logerId; ?>">
                      <div class="form-actions">
                        <div class="row">
                          <div class="offset-md-3 col-md-9">
                            <button type="submit"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary btn-lg _loadingBtn__">Submit</button>
                            <button type="button" onclick="window.history.back()"
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
    const formData = $("#walkInBookingForm");
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