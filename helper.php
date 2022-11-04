<?php
require_once "./App/Model/Database.php";
require_once "./App/Controller/Core.php";
require_once "./App/Controller/Alert.php";
require_once "./App/Controller/Admin.php";
require_once "./App/Controller/Manager.php";
require_once "./App/Controller/Customer.php";
require_once "./App/Controller/Room.php";
require_once "./App/Controller/Admin.php";

$Database = new Database();
$dbh = $Database->osotech_connect();
$Alert = new Alert();
$Core = new Core($dbh, $Alert);
$Admin = new Admin($dbh, $Core, $Alert);
$Manager = new Manager($dbh, $Core, $Alert);
$Customer = new Customer($dbh, $Core, $Alert);
$Room = new Room($dbh, $Core, $Alert);
$Core->osotech_session();