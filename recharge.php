<?php require_once "Helper/customerHelper.php";

?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Recharge Wallet</title>
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
      <?php include_once "Inc/customerSidebar.php"; ?>
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Wallet</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./user-dashbaord">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Wallet</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Recharge Wallet</li>
              </ol>
            </div>
          </div>
          <div class="state-overview">
            <div class="row">
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-success">
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
                </div>
              </div>
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-warning">
                  <span class="info-box-icon push-bottom"><i class="fa fa-money fa-1x"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Amount Recharged</span>
                    <span class="info-box-number">&#8358;
                      <?php if ($walletHistory) {
                        echo number_format($walletHistory->amount, 2);
                      } else {
                        echo "0.00";
                      } ?></span>
                    <div class="progress">
                      <div class="progress-bar width-40"></div>
                    </div>
                    <span class="progress-description">
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 col-12">
                <div class="info-box bg-purple">
                  <span class="info-box-icon push-bottom"><i class="fa fa-calendar"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Recharge Date</span>
                    <span class="info-box-number">
                      <?php if ($walletHistory) {
                        echo date("M jS Y, h:i:s a", strtotime($walletHistory->recharge_at));
                      } else {
                        echo " No Record Found!";
                      } ?></span>
                    <div class="progress">
                      <div class="progress-bar width-80"></div>
                    </div>
                    <span class="progress-description">
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="card card-box">
                <div class="card-head">
                  <header class="text-center">Recharge your Wallet Here</header>
                </div>
                <div class="card-body" id="bar-parent">
                  <form id="walletRechargebySelfForm" class="form-horizontal">
                    <div class="form-body">
                      <div id="response" class="text-center mb-2 col-md-6 offset-3"></div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Token
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="number" autocomplete="off" name="token_pin" data-required="1"
                            placeholder="Enter token here" class="form-control input-height" />
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">Email Address
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" readonly name="email" value="<?php echo $customer_data->email; ?>"
                            class="form-control input-height">
                          <input type="hidden" name="cust_id" value="<?php echo $customer_data->id; ?>">
                          <input type="hidden" name="action" value="top_up_my_wallet_now">
                        </div>
                      </div>

                      <div class="form-actions">
                        <div class="row">
                          <div class="offset-md-3 col-md-9">
                            <button type="submit"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary _loadingBtn__">Recharge
                              Now</button>
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

          <div class="card">
            <div class="card-header">
              <h2 class="lead text-bold text-center mt-3">Wallet Recharge History</h2>
            </div>
            <div class="card-body">
              <div class="table-scrollable">
                <table class="table table-hover table-checkable order-column full-width text-center" id="example4">
                  <thead>
                    <tr>
                      <th class="center"> S/N </th>
                      <th class="center"> Date </th>
                      <th class="center"> Amount Recharged </th>
                      <th class="center">Recharged at</th>
                      <th class="center">Status </th>
                      <th class="center">Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $recharges = $Pin->getAllRechargeHistoryByCustomerId($loggerId);

                    if ($recharges) {
                      $sn = 0;
                      foreach ($recharges as $recharge) {
                        $sn++;
                    ?>
                    <tr>
                      <td><?php echo $sn; ?></td>
                      <td><?php echo date("D M jS, Y", strtotime($recharge->created_at)); ?></td>
                      <td>&#8358;<?php echo number_format($recharge->amount, 2); ?></td>
                      <td><?php echo date("D M jS, Y @ h:i:s a", strtotime($recharge->recharge_at)); ?></td>
                      <td><span class="label label-sm label-success">Success </span></td>
                      <td><button
                          class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger delete_btn_ __loadingBtn_<?php echo $recharge->id; ?>"
                          data-id="<?php echo $recharge->id; ?>" data-action="_remove_recharge_history_">Remove</button>
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
    <?php include_once "Inc/Footer.php"; ?>
    <!-- end footer -->
  </div>
  <?php include_once "Inc/DatatableFooterScript.php"; ?>
  <script>
  $(document).ready(function() {
    //delete token 
    $(".delete_btn_").on("click", function() {
      let _id = $(this).data("id");
      let _action = $(this).data("action");
      if (confirm("Are you sure you want to remove this Token?")) {
        //make a delete request
        $(".__loadingBtn_" + _id).html("wait...").attr("disabled", true);
        $.post("App/Controller/Actions", {
          action: _action,
          rhid: _id
        }, (data) => {
          setTimeout(() => {

            $(".__loadingBtn_" + _id).html("Delete").attr("disabled", false);
            $("#server-response").html(data);
          }, 500);
        });
      } else {
        return;
      }
    });
    //
    const RechargeTokenForm = $("#walletRechargebySelfForm");
    RechargeTokenForm.on("submit", (e) => {
      e.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", RechargeTokenForm.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Recharge Now").attr("disabled", false);
          $("#response").html(res);
        }, 1000);
      })
    })
  })
  </script>
</body>

</html>