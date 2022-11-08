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

$Admin->isAdminLoggedIn();

$admin_data = $Admin->getAdminById($_SESSION['AGOS_ADMIN_UNIQUE_ID']);
$app_data = $Admin->getAppInfo();