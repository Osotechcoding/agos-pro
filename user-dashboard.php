<?php require_once "Helper/customerHelper.php"; ?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php require_once "Inc/MetaTag.php"; ?>
  <title>Customer Dashboard</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->

    <?php include_once "Inc/customerHeader.php" ?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/customerSidebar.php"; ?>
      <!-- end sidebar menu -->
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Welcome! <strong> <?php echo ucwords($customer_data->fullname); ?></strong>
                </div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./user-dashboard">Home</a>&nbsp;<i
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
                  <span class="info-box-icon push-bottom"><i class="fa fa-credit-card-alt "></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Wallet Balance</span>
                    <span
                      class="info-box-number">&#8358;<?php echo number_format($customer_wallet_details->balance, 2) ?></span>
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
                <div class="info-box bg-info">
                  <span class="info-box-icon push-bottom"><i class="fa fa-shopping-cart fa-1x"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">My Orders</span>
                    <span
                      class="info-box-number"><?php echo number_format($Room->countInvoiceByCustomerId($loggerId)); ?></span>
                    <div class="progress">
                      <div
                        class="progress-bar width-<?php echo number_format($Room->countInvoiceByCustomerId($loggerId)); ?>">
                      </div>
                    </div>
                    <span class="progress-description">
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-success">
                  <span class="info-box-icon push-bottom"><i class="fa fa-bed"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Available</span>
                    <span class="info-box-number"><?php echo number_format($Room->countAllRoomsByStatus(0)); ?></span>
                    <div class="progress">
                      <div class="progress-bar width-60"></div>
                    </div>
                    <span class="progress-description">

                    </span>
                  </div>

                </div>

              </div>

            </div>
          </div>
          <?php include_once "Inc/myrecentbooking.php"; ?>

        </div>
      </div>
    </div>
    <?php include_once "Inc/Footer.php"; ?>
    <!-- end footer -->
  </div>
  <?php include_once("Inc/FooterScript.php"); ?>
</body>

</html>