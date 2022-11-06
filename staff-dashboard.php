<?php require_once "Helper/staffHelper.php"; ?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Staff Dashboard</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">

    <?php include_once "Inc/staffHeader.php" ?>

    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/staffSidebar.php"; ?>

      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Welcome! <strong> <?php echo ucfirst($staff_data->fullname); ?></strong> </div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./staff-dashboard">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li class="active">Dashboard</li>
              </ol>
            </div>
          </div>
          <!-- start widget -->
          <div class="state-overview">
            <div class="row">
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-black">
                  <span class="info-box-icon push-bottom"><i class="fa fa-briefcase "></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Customers</span>
                    <span class="info-box-number"><?php echo number_format($Customer->countAllCustomers()); ?></span>
                    <div class="progress">
                      <div class="progress-bar width-60"></div>
                    </div>
                    <span class="progress-description">

                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- /.col -->
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-purple">
                  <span class="info-box-icon push-bottom"><i class="fa fa-bed"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Rooms</span>
                    <span class="info-box-number"><?php echo number_format($Room->countAllRooms()) ?></span>
                    <div class="progress">
                      <div class="progress-bar width-80"></div>
                    </div>
                    <span class="progress-description">

                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-danger">
                  <span class="info-box-icon push-bottom"><i class="fa fa-bed"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Booked</span>
                    <span class="info-box-number"><?php echo number_format($Room->countAllRoomsByStatus(1)); ?></span>
                    <div class="progress">
                      <div class="progress-bar width-60"></div>
                    </div>
                    <span class="progress-description">

                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
          </div>
          <!-- end widget -->
          <div class="state-overview">
            <div class="row">
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-success">
                  <span class="info-box-icon push-bottom"><i class="fa fa-bed "></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Unbooked</span>
                    <span class="info-box-number"><?php echo number_format($Room->countAllRoomsByStatus(0)); ?></span>
                    <div class="progress">
                      <div class="progress-bar width-60"></div>
                    </div>
                    <span class="progress-description">

                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-warning">
                  <span class="info-box-icon push-bottom"><i class="fa fa-bed fa-1x"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Pending CheckIn</span>
                    <span class="info-box-number"><?php echo number_format($Room->countPendingBookings(1)) ?></span>
                    <div class="progress">
                      <div class="progress-bar width-40"></div>
                    </div>
                    <span class="progress-description">

                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-primary">
                  <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Today's Sales</span>
                    <span class="info-box-number"><?php echo number_format($Room->getTodaysRevenue(), 2) ?></span>
                    <div class="progress">
                      <div class="progress-bar width-80"></div>
                    </div>
                    <span class="progress-description">

                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="card  card-box">
                <div class="card-head">
                  <header class="mt-3 mb-3">New Customer</header>
                  <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                  </div>
                </div>
                <div class="card-body ">
                  <div class="table-wrap">
                    <div class="table-responsive">
                      <table class="table display product-overview mb-30 text-center" id="support_table5">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Reg Date</th>
                            <th>Account Status</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $recentCustomers = $Customer->getRecentCustomerRegistration();
                          if ($recentCustomers) {
                            $sn = 0;
                            foreach ($recentCustomers as $cust) {
                              $sn++;
                          ?>
                          <tr>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo ucwords($cust->fullname); ?></td>
                            <td><?php echo $cust->email; ?></td>
                            <td><?php echo $cust->phone; ?></td>
                            <td>
                              <?php echo $cust->address; ?>
                            </td>
                            <td><?php echo date("D M jS, Y", strtotime($cust->created_at)); ?></td>
                            <td><?php echo $cust->verified == '0' ? '<span
                                class="label label-sm label-danger">Not Verified</span>' : '<span
                                class="label label-sm label-success">Verified</span>'; ?> </td>

                          </tr>
                          <?php
                              # code...
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
    <?php include_once "Inc/Footer.php"; ?>
  </div>
  <?php include_once("Inc/FooterScript.php"); ?>
</body>

</html>