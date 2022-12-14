<?php
require_once "App/Model/Database.php";
spl_autoload_register(function ($class_def) {
  require "App/Controller/" . $class_def . ".php";
});

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

$Manager->isStaffLoggedIn();
$logerId = $_SESSION['AGOS_STAFF_UNIQUE_ID'];
$staff_data = $Manager->getStaffById($logerId);
$app_data = $Admin->getAppInfo();