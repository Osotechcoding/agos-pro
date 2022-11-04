<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Admin Dashboard</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
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
                <div class="page-title">Demo</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li class="active">Page</li>
              </ol>
            </div>
          </div>
          <!-- add content here -->
        </div>
      </div>
      <!-- end page content -->
      <!-- start chat sidebar -->

      <!-- end chat sidebar -->
    </div>
    <!-- end page container -->
    <!-- start footer -->
    <?php include_once "Inc/Footer.php"; ?>
    <!-- end footer -->
  </div>
  <!-- start js include path -->
  <?php include_once "Inc/FooterScript.php"; ?>
  <!-- end js include path -->
</body>




</html>