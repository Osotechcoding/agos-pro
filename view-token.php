<?php
require_once "Helper/staffHelper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Admin Dashboard</title>
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

      <?php include_once "Inc/staffSidebar.php"; ?>

      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Wallet Tokens</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./staff-dashboard">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Wallet</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active"> Wallet Tokens</li>
              </ol>
            </div>
          </div>
          <div class="state-overview">

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

</body>

</html>