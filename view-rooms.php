<?php require_once "Helper/staffHelper.php"; ?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Add Room</title>
  <!-- icons -->
  <?php include_once("Inc/DatatableHeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/staffHeader.php" ?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/staffSidebar.php"; ?>
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

                </div>
                <div class="card-body ">
                  <div class="row p-b-20">
                    <div class="col-md-6 col-sm-6 col-6">
                      <div class="btn-group">
                        <a href="create-room" id="addRow" class="btn btn-info btn-circle">
                          Add New <i class="fa fa-plus"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="table-scrollable">
                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                      <thead>
                        <tr>

                          <th class="center"> # </th>
                          <th class="center"> img </th>
                          <th class="center"> Type </th>
                          <th class="center">Amenities </th>
                          <th class="center"> Desc </th>
                          <th class="center"> Price </th>
                          <th class="center"> Status </th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php $allRooms = $Room->getAllRooms();

                        if ($allRooms) {
                          $cnt = 0;
                          foreach ($allRooms as $room) {
                            $cnt++;
                        ?>
                        <tr class="odd gradeX">

                          <td class="center"><?php echo $cnt; ?></td>
                          <td>
                            <img src="image/<?php echo $room->firstImage; ?>" width="100" style="width:80px;height:50px"
                              alt="">
                          </td>
                          <td class="center"><?php echo $room->room_type; ?></td>
                          <td class="center"><?php echo $room->acType; ?></td>
                          <td class="center"><?php echo $room->room_desc; ?></td>
                          <td class="center">&#8358;<?php echo number_format($room->price, 2); ?></td>

                          <td class="center">
                            <?php echo (bool)$room->is_booked == '0' ? '<span class="badge badge-success badge-pill">Available</span>' : ' <span class="badge badge-danger badge-pill">Booked</span>'; ?>
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