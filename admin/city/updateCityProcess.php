<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/city/CityService.php';

session_start();

$cityService = new CityService();
$cityService->update($_GET['id'], $_POST['name']);
echo ("update Successfull");

?>