<?php
require_once "Helper/customerHelper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Rooms</title>
  <!-- icons -->
  <?php include_once("Inc/DatatableHeaderScript.php"); ?>
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

      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Booking History</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="user-dashboard">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Booking</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active"> Booking</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-box">
                <div class="card-head">
                  <header> My Booking History</header>
                  <button type="button" onclick="window.history.back()"
                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger mt-3">Back</button>
                </div>
                <div class="card-body ">
                  <div class="row p-b-20">
                    <div class="col-md-6 col-sm-6 col-6">
                      <div class="btn-group">
                        <a href="booking-arena" id="addRow" class="btn btn-info">
                          Make Booking <i class="fa fa-bed"></i>
                        </a>

                      </div>

                    </div>
                  </div>
                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                      <thead>
                        <tr>
                          <th class="center">Ref Code</th>
                          <th class="center"> Check-In </th>
                          <th class="center"> Check-Out </th>
                          <th class="center"> Room & Type </th>
                          <th class="center">Bill</th>
                          <th class="center"> Payment Method </th>
                          <th class="center"> Booked Date </th>
                          <th class="center"> Print Receipt </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $recentBookings = $Room->getAllMyBookingHistoryById($loggerId);
                        if ($recentBookings) {
                          $cnt = 0;
                          foreach ($recentBookings as $recent) {
                            $customer_data = $Customer->getCustomerById($recent->customer_id);
                            $room_data = $Room->getRoomById($recent->room_id);
                            $cnt++;
                        ?>
                        <tr class="odd gradeX">
                          <td class="center">
                            <?php echo $recent->ref_code; ?>
                          </td>
                          <td class="center"><?php echo date("Y-m-d", strtotime($recent->checkIn)); ?></td>
                          <td class="center"><?php echo date("Y-m-d", strtotime($recent->checkOut)); ?></td>
                          <td class="center"><?php echo $room_data->room_name; ?><br />
                            <?php echo $room_data->room_type; ?><br />
                            &#8358;<?php echo number_format($room_data->price, 2); ?>
                            per
                            Night
                          </td>
                          <td class="center">&#8358;<?php echo number_format($recent->total_bill, 2); ?>
                            <br />
                            <span class="label label-md label-success"><?php echo $recent->total_night; ?>
                              Night</span>
                          </td>
                          <td class="center">Wallet</td>
                          <td class="center"><?php echo date("Y-m-d", strtotime($recent->created_at)); ?></td>
                          <td class="center"><a
                              href="my-invoice?bookingId=<?php echo $recent->id; ?>&action=print-invoice&cid=<?php echo $loggerId; ?>"><button
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary"><span
                                  class="fa fa-print"></span>
                                Print</button></a>
                          </td>
                        </tr>
                        <?php
                          }
                        }

                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end page content -->
    </div>
    <!-- end page container -->
    <?php include_once "Inc/Footer.php"; ?>
  </div>
  <!-- start js include path -->
  <?php include_once "Inc/DatatableFooterScript.php"; ?>
</body>

</html>