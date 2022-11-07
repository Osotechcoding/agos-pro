<?php
require_once "Helper/helper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php
  include_once "Inc/MetaTag.php"; ?>
  <title> Booking List</title>
  <!-- icons -->
  <?php include_once("Inc/DatatableHeaderScript.php"); ?>
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
      <!-- end sidebar menu -->
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title"><span class="fa fa-users fa-1x"></span> All Bookings</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Bookings</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">All Bookings</li>
              </ol>
            </div>
          </div>
          <ul class="nav nav-pills nav-pills-rose">
            <li class="nav-item tab-all"><a class="nav-link active show" href="#tab4" data-bs-toggle="tab">All
              </a>
            </li>
            <li class="nav-item tab-all"><a class="nav-link show" href="#tab1" data-bs-toggle="tab">Pending
              </a>
            </li>
            <li class="nav-item tab-all"><a class="nav-link" href="#tab2" data-bs-toggle="tab">Accepted </a>
            </li>
            <li class="nav-item tab-all"><a class="nav-link" href="#tab3" data-bs-toggle="tab">Rejected</a>
            </li>
          </ul>
          <div class="tab-content tab-space">
            <div class="tab-pane active show" id="tab4">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-box">

                    <div class="card-body">

                      <div class="table-scrollable table-responsive">
                        <table class="table table-checkable order-column full-width text-center osotech_datatable">
                          <thead>
                            <tr>
                              <th class="center">Booking Id</th>
                              <th class="center"> Customer </th>
                              <th class="center"> Mobile & Email </th>
                              <th class="center"> Check-In </th>
                              <th class="center"> Check-Out </th>
                              <th class="center"> Room Type </th>
                              <th class="center">Total Biil</th>
                              <th class="center"> Approval </th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php $all = $Room->getAllBookings();
                            if ($all) {
                              $cnt = 0;
                              foreach ($all as $item) {
                                $customer_data = $Customer->getCustomerById($item->customer_id);
                                $room_data = $Room->getRoomById($item->room_id);
                                $cnt++;
                            ?>
                            <tr class="odd gradeX">
                              <td class="center">
                                <?php echo $item->ref_code; ?>
                              </td>
                              <td class="center"><?php echo $customer_data->fullname; ?></td>
                              <td class="center"><a href="tel:<?php echo $customer_data->phone; ?>">
                                  <?php echo $customer_data->phone; ?> </a><br><a
                                  href="mailto:<?php echo $customer_data->email; ?>">
                                  <?php echo $customer_data->email; ?> </a></td>
                              <td class="center"><?php echo date("Y-m-d", strtotime($item->checkIn)); ?></td>
                              <td class="center"><?php echo date("Y-m-d", strtotime($item->checkOut)); ?></td>
                              <td class="center"><?php echo $room_data->room_name; ?><br />
                                <?php echo $room_data->room_type; ?><br />
                                <span
                                  class="label label-sm label-info">&#8358;<?php echo number_format($room_data->price, 2); ?>
                                  per
                                  Night
                                </span>
                              </td>
                              <td class="center"><span
                                  class="label label-sm label-info">&#8358;<?php echo number_format($item->total_bill, 2); ?>
                                </span><br />
                                <span class="label label-sm label-success"><?php echo $item->total_night; ?>
                                  Night</span>

                              </td>
                              <td class="center">
                                <?php
                                    if ($item->is_approved == "0") {
                                      echo '<span class="label label-sm label-warning">Pending</span>';
                                    } elseif ($item->is_approved == "1") {
                                      echo '<span class="label label-sm label-success">Approved</span>';
                                    } else {
                                      echo '<span class="label label-sm label-danger">Rejected</span>';
                                    }
                                    ?>
                                <!-- <span class="label label-sm label-warning">Pending </span> -->
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
            <div class="tab-pane show" id="tab1">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-box">
                    <div class="card-body">
                      <div class="table-scrollable table-responsive">
                        <table class="table table-checkable order-column full-width text-center osotech_datatable">
                          <thead>
                            <tr>
                              <th class="center">Booking Id</th>
                              <th class="center"> Customer </th>
                              <th class="center"> Mobile & Email </th>
                              <th class="center"> Check-In </th>
                              <th class="center"> Check-Out </th>
                              <th class="center"> Room Type </th>
                              <th class="center">Total Biil</th>
                              <th class="center"> Status </th>
                              <th class="center"> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $allPendings = $Room->getAllBookingByStatus(0);

                            if ($allPendings) {
                              $cnt = 0;
                              foreach ($allPendings as $pending) {
                                $customer_data = $Customer->getCustomerById($pending->customer_id);
                                $room_data = $Room->getRoomById($pending->room_id);
                                $cnt++;
                            ?>
                            <tr class="odd gradeX">
                              <td class="center">
                                <?php echo $pending->ref_code; ?>
                              </td>
                              <td class="center"><?php echo $customer_data->fullname; ?></td>
                              <td class="center"><a href="tel:<?php echo $customer_data->phone; ?>">
                                  <?php echo $customer_data->phone; ?> </a><br><a
                                  href="mailto:<?php echo $customer_data->email; ?>">
                                  <?php echo $customer_data->email; ?> </a></td>
                              <td class="center"><?php echo date("Y-m-d", strtotime($pending->checkIn)); ?></td>
                              <td class="center"><?php echo date("Y-m-d", strtotime($pending->checkOut)); ?></td>
                              <td class="center"><?php echo $room_data->room_name; ?><br />
                                <?php echo $room_data->room_type; ?><br />
                                <span
                                  class="label label-sm label-info">&#8358;<?php echo number_format($room_data->price, 2); ?>
                                  per
                                  Night
                                </span>
                              </td>
                              <td class="center"><span
                                  class="label label-sm label-info">&#8358;<?php echo number_format($pending->total_bill, 2); ?>
                                </span><br />
                                <span class="label label-sm label-success"><?php echo $pending->total_night; ?>
                                  Night</span>

                              </td>
                              <td class="center">
                                <span class="label label-sm label-warning">Pending </span>
                              </td>
                              <td class="center">
                                <button type="button" data-id="<?php echo $pending->id; ?>"
                                  data-room="<?php echo $pending->room_id; ?>"
                                  data-username="<?php echo $pending->customer_id; ?>" data-action="approve"
                                  class="btn btn-xs btn-success approve_btn">
                                  Approve
                                </button>
                                <button type="button" data-room="<?php echo $pending->room_id; ?>"
                                  data-username="<?php echo $pending->customer_id; ?>"
                                  data-id="<?php echo $pending->id; ?>" data-action="reject"
                                  class="btn btn-xs btn-danger reject_btn">
                                  Reject
                                </button>
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
            <div class="tab-pane show" id="tab2">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-box">

                    <div class="card-body">

                      <div class="table-scrollable">
                        <table class="table table-checkable order-column full-width text-center osotech_datatable">
                          <thead>
                            <tr>
                              <th class="center">Ref Code</th>
                              <th class="center"> Customer </th>
                              <th class="center"> Mobile & Email </th>
                              <th class="center"> Check-In </th>
                              <th class="center"> Check-Out </th>
                              <th class="center"> Room Type </th>
                              <th class="center">Total Biil</th>
                              <th class="center"> Status </th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php $allAccepted = $Room->getAllBookingByStatus(1);

                            if ($allAccepted) {
                              $cnt = 0;
                              foreach ($allAccepted as $approved) {
                                $customer_data = $Customer->getCustomerById($approved->customer_id);
                                $room_data = $Room->getRoomById($approved->room_id);
                                $cnt++;
                            ?>
                            <tr class="odd gradeX">
                              <td class="center">
                                <?php echo $approved->ref_code; ?>
                              </td>
                              <td class="center"><?php echo $customer_data->fullname; ?></td>
                              <td class="center"><a href="tel:<?php echo $customer_data->phone; ?>">
                                  <?php echo $customer_data->phone; ?> </a><br><a
                                  href="mailto:<?php echo $customer_data->email; ?>">
                                  <?php echo $customer_data->email; ?> </a></td>
                              <td class="center"><?php echo date("Y-m-d", strtotime($approved->checkIn)); ?></td>
                              <td class="center"><?php echo date("Y-m-d", strtotime($approved->checkOut)); ?></td>
                              <td class="center"><?php echo $room_data->room_name; ?><br />
                                <?php echo $room_data->room_type; ?><br />
                                <span
                                  class="label label-sm label-info">&#8358;<?php echo number_format($room_data->price, 2); ?>
                                  per
                                  Night
                                </span>
                              </td>
                              <td class="center"><span
                                  class="label label-sm label-info">&#8358;<?php echo number_format($approved->total_bill, 2); ?>
                                </span><br />
                                <span class="label label-sm label-success"><?php echo $approved->total_night; ?>
                                  Night</span>

                              </td>
                              <td class="center">
                                <span class="label label-sm label-success">Approved </span>
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

            <div class="tab-pane show" id="tab3">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-box">

                    <div class="card-body">

                      <div class="table-responsive">
                        <table class="table table-checkable order-column full-width text-center osotech_datatable">
                          <thead>
                            <tr>
                              <th class="center">Ref Code</th>
                              <th class="center"> Customer </th>
                              <th class="center"> Mobile & Email </th>
                              <th class="center"> Check-In </th>
                              <th class="center"> Check-Out </th>
                              <th class="center"> Room Type </th>
                              <th class="center">Total Biil</th>
                              <th class="center"> Status </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $allRejected = $Room->getallRejectedBookings();

                            if ($allRejected) {
                              $cnt = 0;
                              foreach ($allRejected as $rejected) {
                                $customer_data = $Customer->getCustomerById($rejected->customer_id);
                                $room_data = $Room->getRoomById($rejected->room_id);
                                $cnt++;
                            ?>
                            <tr class="odd gradeX">
                              <td class="center">
                                <?php echo $rejected->ref_code; ?>
                              </td>
                              <td class="center"><?php echo $customer_data->fullname; ?></td>
                              <td class="center"><a href="tel:<?php echo $customer_data->phone; ?>">
                                  <?php echo $customer_data->phone; ?> </a><br><a
                                  href="mailto:<?php echo $customer_data->email; ?>">
                                  <?php echo $customer_data->email; ?> </a></td>
                              <td class="center"><?php echo date("Y-m-d", strtotime($rejected->checkIn)); ?></td>
                              <td class="center"><?php echo date("Y-m-d", strtotime($rejected->checkOut)); ?></td>
                              <td class="center"><?php echo $room_data->room_name; ?><br />
                                <?php echo $room_data->room_type; ?><br />
                                <span
                                  class="label label-sm label-info">&#8358;<?php echo number_format($room_data->price, 2); ?>
                                  per
                                  Night
                                </span>
                              </td>
                              <td class="center"><span
                                  class="label label-sm label-info">&#8358;<?php echo number_format($rejected->total_bill, 2); ?>
                                </span><br />
                                <span class="label label-sm label-success"><?php echo $rejected->total_night; ?>
                                  Night</span>

                              </td>
                              <td class="center">
                                <span class="label label-sm label-danger">Rejected </span>
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
        </div>
      </div>
    </div>
    <?php include_once "Inc/Footer.php"; ?>
  </div>
  <?php include_once "Inc/DatatableFooterScript.php"; ?>
  <script>
  $(document).ready(function() {
    $(".osotech_datatable").dataTable();
    let rejectBtn = $(".reject_btn");
    approveCustomerBooking(rejectBtn);

    let approveBtn = $(".approve_btn");
    approveCustomerBooking(approveBtn);
  });

  function approveCustomerBooking(actionBtn) {
    actionBtn.on("click", function() {
      let bookingId = $(this).data("id");
      let action = $(this).data("action");
      let customer_id = $(this).data("username");
      let rId = $(this).data("room");
      if (confirm(`Are you sure, You want to ${action} this Booking?`)) {
        //send request
        $.post("App/Controller/Actions", {
          action: action,
          bookingId: bookingId,
          customerId: customer_id,
          rId: rId
        }, (response) => {
          setTimeout(() => {
            console.log(response);
            $("#server-response").html(response);
          }, 500);
        });
      } else {
        return false;
      }
    });
  }
  </script>
</body>

</html>