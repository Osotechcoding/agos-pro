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
  <title>Admin Dashboard</title>
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

          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="card card-box">
                <div class="card-head">
                  <header class="text-center">Generate Customer Wallet Recharge Token</header>
                </div>
                <div class="card-body" id="bar-parent">
                  <form id="generateWalletTokenForm" class="form-horizontal">
                    <div class="form-body">
                      <div class="form-group row">
                        <label class="control-label col-md-3">No of Token
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="number" name="no_of_token" data-required="1"
                            placeholder="Enter No of token to generate" class="form-control input-height" />
                          <span class="text-danger">Max: 200 Tokens at Once</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Token Amount
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="number" autocomplete="off" name="price" data-required="1"
                            placeholder="Enter amount" class="form-control input-height" />
                        </div>
                      </div>


                      <div class="form-actions">
                        <div class="row">
                          <input type="hidden" name="action" value="admin_generate_wallet_token_action">
                          <div class="offset-md-3 col-md-9">
                            <button type="submit"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary _loadingBtn__">Genrate
                              Now</button>
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
            <div class="card-body">
              <div class="table-scrollable">
                <table class="table table-checkable order-column full-width text-center" id="example4">
                  <thead>
                    <tr>

                      <th class="center"> S/N </th>
                      <th class="center"> Token </th>
                      <th class="center"> Amount </th>
                      <th class="center">Status </th>
                      <th class="center"> Created at </th>
                      <th class="center"> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $activeTokens = $Pin->getAllWalletToken();
                    if ($activeTokens) {
                      $cnt = 0;
                      foreach ($activeTokens as $walletToken) {
                        $cnt++; ?>
                    <tr>
                      <td><?php echo $cnt; ?></td>
                      <td><?php echo $walletToken->token; ?></td>
                      <td>&#8358;<?php echo number_format($walletToken->amount, 2); ?></td>
                      <td>
                        <?php echo $walletToken->status == '0' ? '<span class="label label-success label-xs label-rouded">Active</span>' : '<span class="label label-danger label-xs label-rouded">Used</span>'; ?>
                      </td>
                      <td><?php echo date("D M jS Y", strtotime($walletToken->created_at)); ?></td>
                      <td> <?php if ($walletToken->status == '0') { ?>
                        <button type="button" disabled class="label label-warning label-xs label-rouded">
                          Not Allowed</button>
                        <?php
                                } else { ?>
                        <button type="button"
                          class="label label-danger label-md label-rouded remove_token_btn token_btn_<?php echo $walletToken->id; ?>"
                          data-id="<?php echo $walletToken->id; ?>"
                          data-action="remove_token_from_table">Delete</button>
                        <?php } ?>
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
    $(".remove_token_btn").on("click", function() {
      let token_id = $(this).data("id");
      let token_action = $(this).data("action");
      if (confirm("Are you sure you want to remove this Token?")) {
        //make a delete request
        $(".token_btn_" + token_id).html("wait...").attr("disabled", true);
        $.post("App/Controller/Actions", {
          action: token_action,
          wallet_token_id: token_id
        }, (data) => {
          setTimeout(() => {

            $(".token_btn_" + token_id).html("Delete").attr("disabled", false);
            $("#server-response").html(data);
          }, 500);
        });
      } else {
        return;
      }
    });
    const formData = $("#generateWalletTokenForm");
    formData.on("submit", (e) => {
      e.preventDefault();
      $("._loadingBtn__").html("Loading...").attr("disabled", true);
      $.post("App/Controller/Actions", formData.serialize(), (res) => {
        setTimeout(() => {
          $("._loadingBtn__").html("Generate Now").attr("disabled", false);
          // console.log(res);
          $("#server-response").html(res);
        }, 1000);
      })
    });
  })
  </script>
</body>

</html>