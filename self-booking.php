<?php
require_once "Helper/customerHelper.php";


// echo ;

if (isset($_REQUEST['roomId']) && isset($_REQUEST['action']) && isset($_REQUEST['cid']) && !$Core->isEmptyStr($_REQUEST['roomId']) && !$Core->isEmptyStr($_REQUEST['cid'])) {
  $roomId = $Core->sanitise_string($_REQUEST['roomId']);
  $cid = $Core->sanitise_string($_REQUEST['cid']);
  $room_details = $Room->getRoomById($roomId);
  $customer_wallet_details = $Customer->getCustomerWalletDetailsById($cid);
} else {
  @header("Location: ./booking-arena");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Self Booking</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <?php include_once "Inc/customerHeader.php" ?>

    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/customerSidebar.php"; ?>
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Make Booking Order</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./user-dashboard">Home</a>&nbsp;<i
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
                    <h2>Make Reservation Order for <strong
                        class="text-primary"><?php echo strtoupper($room_details->room_name); ?></strong> &raquo;
                      &raquo;
                      <small><i><?php echo $room_details->room_type; ?></i></small>
                    </h2>
                  </header>
                </div>
                <div class="card-body" id="bar-parent">
                  <form id="selfBookingForm" class="form-horizontal">
                    <div class="form-body">

                      <div class="form-group row">
                        <label class="control-label col-md-3">Price Per Night
                        </label>
                        <div class="col-md-6">
                          <div class="input-group">
                            <input type="text" readonly class="form-control input-height" autocomplete="off"
                              value="&#8358;<?php echo number_format($room_details->price, 2); ?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Wallet Balance
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" readonly
                            value="&#8358;<?php echo number_format($customer_wallet_details->balance, 2); ?>"
                            class="form-control input-height" />
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">Check-In Date
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <div class="input-append date">
                            <div id="dateIcon" class="input-group datePicker">
                              <input autocomplete="off" class="formDatePicker form-control" type="text"
                                name="check_in_date" placeholder="Select Check-In Date.." data-input>
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
                              <input autocomplete="off" class="formDatePicker form-control" type="text"
                                name="check_out_date" placeholder="Select Check-Out Date.." data-input>
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
                        <label class="control-label col-md-3">No of Guest
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input name="no_of_guest" autocomplete="off" type="number" min="0" max="5"
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
                          <textarea name="comment" class="form-control-textarea" placeholder="Comment"
                            rows="5"></textarea>
                        </div>
                      </div>
                      <input name="cus_balance" type="hidden" value="<?php echo $customer_wallet_details->balance; ?>">
                      <input type="hidden" name="room_price" value="<?php echo $room_details->price; ?>">
                      <input type="hidden" name="action" value="submit_self_booking_form">
                      <input type="hidden" name="room_id" value="<?php echo $room_details->id; ?>">
                      <input type="hidden" name="customer_id" value="<?php echo $customer_data->id; ?>">
                      <input type="hidden" name="agos_tokens" value="2289484748448">
                      <div class="form-actions">
                        <div class="row">
                          <div class="offset-md-3 col-md-9">
                            <button type="submit"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary btn-lg _loadingBtn__">Make
                              Booking</button>
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
    const formData = $("#selfBookingForm");
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