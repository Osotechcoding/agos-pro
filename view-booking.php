<?php
require_once "Helper/helper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Rooms</title>
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
                <div class="page-title">Rooms</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Rooms</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active"> Rooms</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-box">
                <div class="card-head">
                  <header> Rooms</header>
                  <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                  </div>
                </div>
                <div class="card-body ">
                  <div class="row p-b-20">
                    <div class="col-md-6 col-sm-6 col-6">
                      <div class="btn-group">
                        <a href="add-room" id="addRow" class="btn btn-info">
                          Add New <i class="fa fa-plus"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                      <thead>
                        <tr>
                          <th class="center">Ref Code</th>
                          <th class="center"> Customer </th>
                          <th class="center"> Mobile & Email </th>
                          <th class="center"> Check-In </th>
                          <th class="center"> Check-Out </th>
                          <th class="center"> Room Type </th>
                          <th class="center">Total Biil</th>
                          <th class="center"> Payment </th>
                          <th class="center"> Delete </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="odd gradeX">
                          <td>
                            63337648
                          </td>
                          <td class="center">Rajesh</td>
                          <td class="center"><a href="tel:4444565756">
                              4444565756 </a><br><a href="mailto:rajesh@gmail.com ">
                              rajesh@gmail.com </a></td>
                          <td class="center">23/04/2017</td>
                          <td class="center">25/04/2017</td>
                          <td class="center">Single</td>
                          <td class="center">&#8358; 40,000.00</td>
                          <td class="center">
                            <span class="label label-sm label-success">Paid </span>
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