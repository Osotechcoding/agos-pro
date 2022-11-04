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
  <title>Activity Logs</title>
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
                <div class="page-title">Activity Logs</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Activity Logs</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active"> Activity Logs</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-box">
                <div class="card-head">
                  <header> Activity Logs</header>
                  <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                  </div>
                </div>
                <div class="card-body ">

                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                      <thead>
                        <tr>
                          <th class="center">Email</th>
                          <th class="center"> Ip Address </th>
                          <th class="center"> Login at</th>
                          <th class="center">Logout at</th>
                          <th class="center"> Activity Duration (Mins) </th>
                          <th class="center"> Delete </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="odd gradeX">
                          <td class="center">osotech@gmail.com</td>
                          <td class="center">1192.158.1.38.</td>

                          <td class="center"><?php echo date("Y-m-d H:i:s a"); ?></td>
                          <td class="center"><?php echo date("Y-m-d H:i:s a", strtotime("+ 30 minutes")); ?></td>
                          <td class="center">
                            <span class="label label-sm label-success">
                              230
                            </span>
                          </td>
                          <td class="center">
                            <button type="button" class="btn btn-xs btn-dark">
                              <i class="fa fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-xs btn-danger">
                              <i class="fa fa-trash-o"></i>
                            </button>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end page content -->
    </div>
    <!-- end page container -->
    <?php include_once "Inc/Footer.php"; ?>
  </div>
  <!-- start js include path -->
  <?php include_once "Inc/DatatableFooterScript.php"; ?>
</body>

</html>