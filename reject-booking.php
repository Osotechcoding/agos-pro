<?php require_once "Helper/staffHelper.php";
if (isset($_GET['bookingId'], $_GET['userId'], $_GET['roomId'], $_GET['action'], $_GET['cid']) && $_GET['bookingId'] != "" && $_GET['cid'] != "" && $_GET['roomId'] != "" && $_GET['action'] === "reject") {
  $roomId = $Core->sanitise_string($_GET['roomId']);
  $userId = $Core->sanitise_string($_GET['userId']);
  $cid = $Core->sanitise_string($_GET['cid']);
  $bookingId = $Core->sanitise_string($_GET['bookingId']);
  $booking_data = $Room->getBookingById($bookingId);
  $customer_data = $Customer->getCustomerById($cid);
  $room_data = $Room->getRoomById($roomId);
} else {
  echo "<script>
  window.location.href='./bookings';
  </script>";
}
?>
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
                <div class="page-title">Add New Room</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="javascript:void(0);">Reject</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Reject Booking</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="card card-box">
                <div class="card-head">
                  <div class="btn-group m-2">
                    <a href="view-rooms" id="addRow" class="btn btn-dark btn-circle">
                      View Bookings <i class="fa fa-bar-chart"></i>
                    </a>
                  </div>
                  <header class="text-center m-4 text-warning">
                    <h2>Reject <?php echo ucwords($customer_data->fullname) ?> Booking Order</h2>
                  </header>

                </div>
                <div class="card-body" id="bar-parent">
                  <form id="rejectBookingForm" class="form-horizontal">
                    <div class="form-body">
                      <div id="response" class="text-center mb-3"></div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Customer Name
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" name="customer_name" data-required="1"
                            value="<?php echo ucwords($customer_data->fullname) ?>" readonly
                            class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Room Name & Type
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" name="room_name" readonly
                            value="<?php echo ucwords($room_data->room_name) . " &raquo; " . $room_data->room_type; ?>"
                            class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">CheckIn Date
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" readonly name="checkin_date"
                            value="<?php echo date("l jS F Y", strtotime($booking_data->checkIn)); ?>"
                            class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">CheckOut Date
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" readonly name="checkout_date"
                            value="<?php echo date("l jS F Y", strtotime($booking_data->checkOut)); ?>"
                            class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Reject Comment.
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <textarea name="reject_message" placeholder="Write reason for rejecting this booking" rows="3"
                            class="form-control"></textarea>
                        </div>
                      </div>
                      <input type="hidden" name="action" value="recject_booking_by_staff_">
                      <input type="hidden" name="rId" value="<?php echo $room_data->id; ?>">
                      <input type="hidden" name="bookingId" value="<?php echo $booking_data->id; ?>">
                      <input type="hidden" name="customerId" value="<?php echo $customer_data->id; ?>">
                      <input type="hidden" name="userId" value="<?php echo $logerId; ?>">
                      <input type="hidden" name="agos_tokens" value="2289484748448">
                      <div class="form-actions">
                        <div class="row">
                          <div class="offset-md-3 col-md-9">
                            <button type="submit"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary btn-lg btn-block _loadingBtn__">Reject
                              Booking</button>
                            <button type="button" onclick="window.history.back()"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Back</button>

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
    const REJECTBOOKINGFORM = $("#rejectBookingForm");
    REJECTBOOKINGFORM.on("submit", (e) => {
      e.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", REJECTBOOKINGFORM.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Reject Booking").attr("disabled", false);
          $("#response").html(res);
        }, 1000);
      })
    });
  })
  </script>
</body>

</html>