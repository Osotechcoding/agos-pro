<?php
require_once "Helper/helper.php";


if (isset($_REQUEST['cid']) && isset($_REQUEST['action']) && !$Core->isEmptyStr($_REQUEST['cid'])) {
  $cid = $Core->sanitise_string($_REQUEST['cid']);
  $customer_details = $Customer->getCustomerById($cid);
  $customer_wallet_details = $Customer->getCustomerWalletDetailsById($cid);
  $walletHistory = $Customer->getCustomerWalletRechargeHistoryById($cid);
} else {
  @header("Location: ./");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Recharge Customer Wallet</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->

    <?php include_once "Inc/Header.php" ?>

    <div class="page-container">

      <?php include_once "Inc/TopSidebar.php"; ?>

      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Wallet</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
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
                <div class="info-box bg-dark">
                  <span class="info-box-icon push-bottom"><i class="fa fa-money fa-1x"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Last Recharged</span>
                    <span class="info-box-number">&#8358;
                      <?php if ($walletHistory) {
                        echo number_format($walletHistory->amount, 2);
                      } else {
                        echo "0.00";
                      } ?>
                    </span>
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
                      } ?>
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
                  <header class="text-center">Recharge
                    <strong><?php echo strtoupper($customer_details->fullname) ?></strong> Wallet
                  </header>
                </div>
                <div class="card-body" id="bar-parent">
                  <form id="rechargeCustomerTokenForm" class="form-horizontal">
                    <div class="form-body">
                      <div class="form-group row">
                        <label class="control-label col-md-3">Email Address
                          <span class="required"> * </span>
                        </label>
                        <input type="hidden" name="customer_id" value="<?php echo $customer_details->id; ?>">
                        <div class="col-md-6">
                          <input type="text" readonly name="customer_email" data-required="1"
                            value="<?php echo $customer_details->email; ?>"
                            placeholder="Enter your email addres here..." class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Top-Up Wallet
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="number" autocomplete="off" name="token_amount" data-required="1"
                            placeholder="Enter amount" class="form-control input-height" />
                        </div>
                      </div>
                      <input type="hidden" name="action" value="_topUpstomerWallet_submit_">
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
        </div>
      </div>

    </div>
    <?php include_once "Inc/Footer.php"; ?>
    <!-- end footer -->
  </div>
  <?php include_once "Inc/FooterScript.php"; ?>
  <script>
  $(document).ready(function() {
    const tokenForm = $("#rechargeCustomerTokenForm");
    tokenForm.on("submit", (e) => {
      e.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", tokenForm.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Recharge Now").attr("disabled", false);
          $("#server-response").html(res);
        }, 1000);
      })
    })
  })
  </script>
</body>

</html>