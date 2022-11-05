<?php
@session_start();
$resquest_method = $_SERVER['REQUEST_METHOD'];

if ($resquest_method === "GET") {
  if (isset($_GET['action']) && $_GET['action'] !== "") {
    switch ($_GET['action']) {
      case 'customer-logout':
        if (isset($_SESSION['AGOS_CUSTOMER_UNIQUE_ID']) && $_SESSION['AGOS_CUSTOMER_UNIQUE_ID'] !== "") {
          $cid = $_SESSION['AGOS_CUSTOMER_UNIQUE_ID'];
          require_once "Helper/customerHelper.php";
          $Customer->handleCustomerLogout($cid);
        }
        break;

      case 'destroy_admin_session':
        if (isset($_SESSION['AGOS_ADMIN_UNIQUE_ID']) && $_SESSION['AGOS_ADMIN_UNIQUE_ID'] !== "") {
          $aid = $_SESSION['AGOS_ADMIN_UNIQUE_ID'];
          require_once "Helper/helper.php";
          $Admin->handleAdminLogOut($aid);
        }
        break;

      case 'staff-logout':
        if (isset($_SESSION['AGOS_STAFF_UNIQUE_ID']) && $_SESSION['AGOS_STAFF_UNIQUE_ID'] !== "") {
          $mid = $_SESSION['AGOS_STAFF_UNIQUE_ID'];
          require_once "Helper/staffHelper.php";
          $Manager->handleStaffLogOut($mid);
        }
        break;
      default:
        # code...
        break;
    }
  }
}