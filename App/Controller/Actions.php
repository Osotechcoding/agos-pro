<?php

// use App\Model\Database;
require_once "../Model/Database.php";
require_once "Core.php";
require_once "Alert.php";
require_once "Admin.php";
require_once "Manager.php";
require_once "Customer.php";
require_once "Room.php";
require_once "Admin.php";
require_once "Pin.php";

$Database = new Database();
$dbh = $Database->osotech_connect();
$Alert = new Alert();
$Core = new Core($dbh, $Alert);
$Admin = new Admin($dbh, $Core, $Alert);
$Manager = new Manager($dbh, $Core, $Alert);
$Customer = new Customer($dbh, $Core, $Alert);
$Room = new Room($dbh, $Core, $Alert);
$Pin = new Pin($dbh, $Core, $Alert);
$Core->osotech_session();
$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method === "POST") {
  if (isset($_POST['action']) && $_POST['action'] !== "") {
    switch ($_POST['action']) {
      case 'auth_admin_login_form_submit__':
        $result = $Admin->login($_POST);
        if ($result) {
          echo $result;
        }
        break;

      case 'auth_staff_login_form_submit__':
        $result = $Manager->login($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'Unsuspend':
        $result = $Manager->suspendStaff($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'Suspend':
        $result = $Manager->suspendStaff($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'customer_login_form_submit__':
        $result = $Customer->login($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'delete_cust':
        $result = $Customer->delete($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'submit_new_customer_reg_':
        $result = $Customer->customerOnlineRegistration($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'walkin_booking_form_submited_via_staff':
        $result = $Customer->walkInClientBooking($_POST);
        if ($result) {
          echo $result;
        }
        break;

      case 'admin_generate_wallet_token_action':
        $result = $Pin->generateTokenPins($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case '_topUpstomerWallet_submit_':
        $result = $Pin->topUpCustomerWallet($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'top_up_my_wallet_now':
        $result = $Pin->topUpMyWalletByTokenCard($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'remove_token_from_table':
        $result = $Pin->removeUsedWalletTokenPin($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case '_remove_recharge_history_':
        $result = $Pin->deleteMyWalletRechargeHistory($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'register_new_staff_btn':
        $result = $Manager->register($_POST);
        if ($result) {
          echo $result;
        }
        break;

      case 'register_new_customer_btn':
        $result = $Customer->register($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'update_my_acct_pass_':
        $result = $Customer->updateMyPassword($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'send_forgot_pwd_link':
        $result = $Customer->sendCustomerPasswordResetLink($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'update_forgot_pwd_now':
        $result = $Customer->resetCustomerPassword($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'submit_self_booking_form':
        $result = $Customer->bookWithWalletCredit($_POST);
        if ($result) {
          echo $result;
        }
        break;

      case 'add_new_room_':
        $result = $Room->create($_POST, $_FILES);
        if ($result) {
          echo $result;
        }
        break;
      case 'approve':
        $result = $Room->approveDisapproveCustomerBooking($_POST);
        if ($result) {
          echo $result;
        }
        break;

      case 'reject':
        $result = $Room->approveDisapproveCustomerBooking($_POST);
        if ($result) {
          echo $result;
        }
        break;
      case 'recject_booking_by_staff_':
        $result = $Room->rejectCustomerBookingByStaff($_POST);
        if ($result) {
          echo $result;
        }
        break;

      default:
        # code...
        break;
    }
  }
}