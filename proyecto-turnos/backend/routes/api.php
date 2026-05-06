<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controller/turnocontroller.php';

$db = (new Database())->connect();
$controller = new TurnoController($db);

$controller->reservar();