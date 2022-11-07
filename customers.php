<?php
require_once "Helper/staffHelper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title> Customers</title>
  <!-- icons -->
  <?php include_once("Inc/DatatableHeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->

    <?php include_once "Inc/staffHeader.php" ?>

    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/staffSidebar.php"; ?>

      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">All Customers</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./staff-dashboard">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Customers</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">All Customers</li>
              </ol>
            </div>
          </div>
          <ul class="nav nav-pills nav-pills-rose">
            <li class="nav-item tab-all"><a class="nav-link active show" href="#tab1" data-bs-toggle="tab">List
                View</a></li>
            <li class="nav-item tab-all"><a class="nav-link" href="#tab2" data-bs-toggle="tab">Grid View</a>
            </li>

          </ul>
          <div class="tab-content tab-space">
            <div class="tab-pane active show" id="tab1">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-box">

                    <div class="card-body ">
                      <div class="btn-group m-2">
                        <a href="create-customer" id="addRow" class="btn btn-info">
                          Add New Customer <i class="fa fa-plus"></i>
                        </a>
                      </div>

                      <div class="table-scrollable">
                        <table class="table table-checkable order-column full-width" id="example4">
                          <thead>
                            <tr>

                              <th class="center"> Name </th>
                              <th class="center"> Wallet Bal </th>
                              <th class="center"> Mobile </th>
                              <th class="center"> Email </th>
                              <th class="center"> Address </th>
                              <th class="center">Joining Date</th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php $allCustomers = $Customer->getAllCustomers();

                            if ($allCustomers) {
                              $cnt = 0;
                              foreach ($allCustomers as $customer) {
                                $customer_wallet_details = $Customer->getCustomerWalletDetailsById($customer->id);
                                if ($customer_wallet_details) {
                                  $bal = $customer_wallet_details->balance;
                                } else {
                                  $bal = "0.00";
                                }
                                $cnt++;
                            ?>
                            <tr class="odd gradeX">
                              <td class="center"><?php echo $customer->fullname; ?></td>
                              <td class="center">&#8358;<?php echo number_format($bal, 2); ?></td>
                              <td class="center"><a href="tel:<?php echo $customer->phone; ?>">
                                  <?php echo $customer->phone; ?> </a></td>
                              <td class="center"><a href="mailto:<?php echo $customer->email; ?>.com">
                                  <?php echo $customer->email; ?> </a></td>
                              <td class="center"><?php echo $customer->address; ?></td>
                              <td class="center"><?php echo $customer->created_at; ?></td>

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
            <div class="tab-pane" id="tab2">
              <div class="row">
                <?php $allCustomers = $Customer->getAllCustomers();

                if ($allCustomers) {
                  $cnt = 0;
                  foreach ($allCustomers as $customer) {
                    $cnt++;
                ?>
                <div class="col-md-4">
                  <div class="card">
                    <div class="m-b-20">
                      <div class="doctor-profile">
                        <div class="profile-header bg-b-<?php echo $customer->gender == "Male" ? 'purple' : 'pink'; ?>">
                          <div class="user-name"><?php echo $customer->fullname; ?></div>
                          <div class="name-center"><?php echo strtoupper($customer->gender); ?></div>
                        </div>
                        <img src="assets/img/user-image.jpg" class="user-img" alt="">
                        <p>
                          <?php echo $customer->email; ?>
                        </p>
                        <p>
                          <?php echo $customer->address; ?> || <?php echo $customer->state_of_origin; ?>
                        </p>
                        <div>
                          <p>
                            <i class="fa fa-phone"></i><a href="tel:<?php echo $customer->phone; ?>">
                              <?php echo $customer->phone; ?></a>
                          </p>
                          <p> Member Since:
                            <i class="fa fa-calendar"></i>
                            <?php echo date("D M jS, Y", strtotime($customer->created_at)); ?>
                          </p>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                }
                ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once "Inc/Footer.php"; ?>
  </div>
  <?php include_once "Inc/DatatableFooterScript.php"; ?>

</body>

</html>