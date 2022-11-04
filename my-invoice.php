<?php
require_once "Helper/customerHelper.php";

if (isset($_GET['bookingId']) && $_GET['bookingId'] != "" && isset($_GET['cid']) && $_GET['cid'] != "" && isset($_GET['action']) && $_GET['action'] == "print-invoice") {
  $bid = $Core->sanitise_string($_GET['bookingId']);
  $booking_details = $Room->getBookingById($bid);
  $room_details = $Room->getRoomById($booking_details->room_id);
} else {
  echo "<script>window.history.back()</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Invoice</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/customerHeader.php" ?>
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/customerSidebar.php"; ?>
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Invoice</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./user-dashboard">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                <li><a class="parent-item" href="#">Booking</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Invoice</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="white-box">
                <h3><b>RESERVATION RECEIPT</b> <span
                    class="pull-right">#<?php echo $booking_details->ref_code; ?></span></h3>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="pull-left">
                      <address>
                        <img src="assets/img/logo.png" alt="logo" class="logo" style="width:120px; height:120px;" />
                        <p class="text-muted m-l-5 font-bold addr-font-h5"">
                          Office Address:
                          54B, Adeniyi Jones Avenue.<br>Ikeja. Lagos. Nigeria. <br>Email: info@agosoffices.com <br>
                          Phone: +234 705 072 3751 <br>
                        </p>
                      </address>
                    </div>
                    <div class=" pull-right text-right">
                        <address>
                          <p class="addr-font-h3">To,</p>
                          <p class="font-bold addr-font-h4"><?php echo ucwords($customer_data->fullname) ?></p>
                          <p class="text-muted m-l-30">
                            Address: <?php echo $customer_data->address; ?>,<br>
                            Email: <?php echo $customer_data->email; ?>, <br>
                            Phone: <?php echo $customer_data->phone; ?>
                          </p>
                          <p class="m-t-30">
                            <b>Date :</b> <i class="fa fa-calendar"></i>
                            <?php echo date("jS F,Y", strtotime($booking_details->created_at)) ?>
                          </p>
                        </address>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="table-responsive m-t-40">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">CheckIn</th>
                            <th class="text-center">CheckOut</th>
                            <th class="text-center">Descriptions</th>
                            <th class="text-center">Charges per Night</th>
                            <th class="text-center"> Night(s)</th>
                            <th class="text-right">Sub Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">1</td>
                            <td class="text-center"><?php echo date("d-m-Y", strtotime($booking_details->checkIn)) ?>
                            </td>
                            <td class="text-center"><?php echo date("d-m-Y", strtotime($booking_details->checkOut)) ?>
                            </td>
                            <td class="text-center"><?php echo ucwords($room_details->room_name) ?> &raquo;
                              <?php echo $room_details->room_type; ?> </td>
                            <td class="text-center">&#8358;<?php echo number_format($room_details->price, 2); ?></td>
                            <td class="text-center"><?php echo $booking_details->total_night; ?></td>
                            <td class="text-right">
                              &#8358;<?php echo number_format(($room_details->price * $booking_details->total_night), 2); ?>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="pull-right m-t-30 text-right">
                      <p>Sub-Total:
                        &#8358;<?php echo number_format(($room_details->price * $booking_details->total_night), 2); ?>
                      </p>
                      <p>Discount : $0.00 </p>
                      <p>Tax (0%) : $0.00 </p>
                      <hr>
                      <h3><b>Grand Total :</b>
                        &#8358;<?php echo number_format(($room_details->price * $booking_details->total_night), 2); ?>
                      </h3>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="text-right">
                      <!-- <button class="btn btn-danger" type="submit"> Proceed to payment </button> -->
                      <button onclick="javascript:window.print();" class="btn btn-default btn-outline" type="button">
                        <span><i class="fa fa-print"></i> Print</span> </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include_once "Inc/Footer.php"; ?>
  </div>

  <?php include_once "Inc/FooterScript.php"; ?>

</body>

</html>