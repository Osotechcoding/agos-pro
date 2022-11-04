<?php
require_once "Helper/helper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta name="description" content="Responsive Admin Template" />
  <meta name="author" content="SmartUniversity" />
  <title>Admin Dashboard</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <?php include_once "Inc/Header.php" ?>

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
                  <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                    data-upgraded=",MaterialButton">
                    <i class="material-icons">more_vert</i>
                  </button>
                  <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    data-mdl-for="panel-button">
                    <li class="mdl-menu__item"><a href="#"><i class="fa fa-eye"> </i> View Bookings</a>
                    </li>
                    <li class="mdl-menu__item"><a href=""><i class="fa fa-money"> </i> Make Payment</a>
                    </li>
                    <li class="mdl-menu__item"><a href=""><i class="fa fa-line-chart"> </i> Payment Reports</a>
                    </li>
                  </ul>
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
                          <textarea name="address" placeholder="Permanent Address" class="form-control-textarea"
                            rows="5"></textarea>
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
                        <label class="control-label col-md-3">No of People
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <select class="form-select input-height" name="nop">
                            <option value="">Select...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                        </div>
                      </div>



                      <div class="form-group row">
                        <label class="control-label col-md-3">Comment
                        </label>
                        <div class="col-md-6">
                          <textarea name="comment" class="form-control-textarea" placeholder="Comment"
                            rows="5"></textarea>
                        </div>
                      </div>
                      <input type="hidden" name="action" value="walkin_booking_form_submited">
                      <input type="hidden" name="agos_token" value="2289484748448">
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