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
$app_data = $Admin->getAppInfo();