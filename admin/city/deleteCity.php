<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/city/CityService.php';

session_start();

$cityService = new CityService();
$cityService->delete($_GET['id']);
echo ("delete Successfull");

?>