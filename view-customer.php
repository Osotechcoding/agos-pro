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
  <title> Customers</title>
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
                <div class="page-title">All Customers</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
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
                    <div class="card-head">
                      <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                        data-upgraded=",MaterialButton">
                        <i class="material-icons">more_vert</i>
                      </button>
                      <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        data-mdl-for="panel-button">
                        <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action</li>
                        <li class="mdl-menu__item"><i class="material-icons">print</i>Another
                          action</li>
                        <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else here</li>
                      </ul>
                    </div>
                    <div class="card-body ">
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
                              <th class="center">Status</th>
                              <th class="center"> Action </th>
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
                              <td class="center"><span class="badge badge-danger badge-pill badge-md">Banned</span>
                              </td>
                              <td class="center">
                                <a href="recharge-wallet?cid=<?php echo $customer->id; ?>&action=recharge"
                                  class="btn btn-circle btn-info  btn-sm">Top-Up Wallet</a>
                                <button type="button" data-id="<?php echo $customer->id; ?>" data-action="delete_cust"
                                  class="btn btn-circle delete_customer_btn deepPink-bgcolor btn-sm osotech_action_<?php echo $customer->id; ?>">Delete</button>
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
                        <div class="profile-userbuttons">
                          <a href="recharge-wallet?cid=<?php echo $customer->id; ?>&action=recharge"
                            class="btn btn-circle btn-info btn-sm">Top Up Wallet
                            More</a>
                          <button type="button" data-id="<?php echo $customer->id; ?>" data-action="delete_cust"
                            class="btn btn-circle delete_customer_btn deepPink-bgcolor btn-sm osotech_action_<?php echo $customer->id; ?>">Delete</button>
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
  <script>
  $(document).ready(function() {
    let delete_customer_btn = $(".delete_customer_btn");
    deleteCustomer(delete_customer_btn);
  });

  function deleteCustomer(delbtn) {
    delbtn.on("click", function() {
      let custId = $(this).data("id");
      let action = $(this).data("action");
      if (confirm('Are you sure, You want to delete this Customer?')) {
        $(".osotech_action_" + custId).html("Loading...").attr("disabled", true);
        //send request
        $.post("App/Controller/Actions", {
          action: action,
          custId: custId
        }, (response) => {
          $(".osotech_action_" + custId).html('Delete').attr("disabled", false);
          setTimeout(() => {
            console.log(response);
            $("#server-response").html(response);
          }, 1000);
        });
      } else {
        return false;
      }

    });
  }
  </script>
</body>

</html>