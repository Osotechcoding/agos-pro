<?php
require_once "Helper/helper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title> CheckIn - CheckOut Customers</title>
  <!-- icons -->
  <?php include_once("Inc/DatatableHeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/Header.php" ?>

    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/TopSidebar.php"; ?>

      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Approved Booking await Checkin</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Await CheckIn</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Await CheckIn</li>
              </ol>
            </div>
          </div>
          <!-- <ul class="nav nav-pills nav-pills-rose">
            <li class="nav-item tab-all"><a class="nav-link active show" href="#tab1" data-bs-toggle="tab">List
                View</a></li>

          </ul> -->
          <div class="tab-content tab-space">
            <div class="tab-pane active show" id="tab1">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-box">

                    <div class="card-body ">
                      <div class="btn-group m-2">
                        <button type="button" onclick="window.history.back()"
                          class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Go
                          back </button>

                      </div>

                      <div class="table-scrollable">
                        <table class="table text-center table-checkable order-column full-width" id="example4">
                          <thead class="text-center">
                            <tr>
                              <th class="center">Booking Id</th>
                              <th class="center"> Customer </th>
                              <th class="center"> Mobile & Email </th>
                              <th class="center"> Check-In </th>
                              <th class="center"> Check-Out </th>
                              <th class="center"> Room Type </th>
                              <th class="center">Total Biil</th>
                              <th class="center">Confirm Check-In </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $allAccepted = $Room->getAwaitingApprovalBookings();

                            if ($allAccepted) {
                              $cnt = 0;
                              foreach ($allAccepted as $approved) {
                                $customer_data = $Customer->getCustomerById($approved->customer_id);
                                $room_data = $Room->getRoomById($approved->room_id);
                                $cnt++;
                            ?>
                            <tr>
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
                                <?php if ($approved->status == '1') : ?>
                                <button class="btn btn-circle btn-success  btn-sm checkIn_btn_ loadin_btn"
                                  data-id="<?php echo $approved->id; ?>" data-action="confirm_checkIn_">Check
                                  In</button>
                                <?php else : ?>
                                <button class="btn btn-circle btn-danger btn-sm checkOut_btn_ loadin_btn_"
                                  data-id="<?php echo $approved->id; ?>" data-action="confirm_checkOut_">Check
                                  Out</button>
                                <?php endif; ?>
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
    let checkOut_loading_btn = $(".loadin_btn_");
    let checkOutBtn = $(".checkOut_btn_");
    checkInCheckOutCustomer(checkOutBtn, checkOut_loading_btn);

    let checkin_loading_btn = $(".loadin_btn");
    let checkInBtn = $(".checkIn_btn_");
    checkInCheckOutCustomer(checkInBtn, checkin_loading_btn);
  });

  function checkInCheckOutCustomer(actionBtn, loadingBtn) {
    actionBtn.on("click", function() {
      let bookingId = $(this).data("id");
      let action = $(this).data("action");
      if (confirm(`Are you sure, You want to confirm this action?`)) {
        loadingBtn.html("loading...")
        //send request
        $.post("App/Controller/Actions", {
          action: action,
          checkInId: bookingId
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