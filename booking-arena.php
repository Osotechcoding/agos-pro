<?php
require_once "Helper/customerHelper.php";
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
  <title>Rooms List</title>
  <!-- icons -->
  <?php include_once("Inc/DatatableHeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->

    <?php include_once "Inc/customerHeader.php" ?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/customerSidebar.php"; ?>
      <!-- end sidebar menu -->
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">All Available Rooms <a href="javascript:void(0);" class="text-danger"
                    onclick="window.history.back()">Go Back</a></div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./user-dashboard">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="javascript:void(0);">Rooms</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Room List</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <?php $allRooms = $Room->getAllActiveRooms();
            if ($allRooms) {
              foreach ($allRooms as $room) {
            ?>
            <div class="col-md-4">
              <div class="card">
                <div class="m-b-20">
                  <div class="doctor-profile">
                    <div class="profile-header bg-purple">
                      <div class="user-name"><?php echo strtoupper($room->room_name); ?></div>
                      <div class="name-center"><?php echo strtoupper($room->room_type); ?>
                      </div>
                    </div>
                    <img src="image/<?php echo $room->firstImage; ?>" class="media-object" alt="" width="100%">
                    <h4>
                      Description: <?php echo $room->room_desc; ?>
                    </h4><span>
                      <?php
                          $arr_facilities = explode(",", $room->facilities);
                          foreach ($arr_facilities as $facility) {
                            echo ' <span class="badge badge-primary badge-md badge-pill">' . $facility . '</span>';
                          }
                          ?>
                    </span>
                    <div>
                      <p>
                      <h3> Per Night: <strong><span class="label label-danger label-lg">&#8358;
                            <?php echo number_format($room->price, 2); ?> </span></strong>
                      </h3>
                      </p>
                    </div>
                    <div class="profile-userbuttons">
                      <a
                        href="self-booking?roomId=<?php echo $room->id; ?>&cid=<?php echo $loggerId; ?>&action=book-room"><button
                          class="btn btn-circle deepPink-bgcolor btn-md">Book Now</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
              }
            } else {
              echo '<div class="col-md-4 text-center">' . $Alert->alertMessage("NOTICE:", "No available rooms at the moment, check back later!", "danger") . '</div>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <?php include_once "Inc/Footer.php"; ?>
  </div>
  <?php include_once "Inc/DatatableFooterScript.php"; ?>
</body>

</html>