<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/city/CityService.php';

session_start();

$cityName = $_POST['name'];
if (empty($cityName)) {
    die('Please enter city name');
}

$stateId = $_POST['stateId'];
if (empty($cityName)) {
    die('Please select parent state');
}

$cityService = new CityService();
$cityService->save($cityName, $stateId);
echo ("successfull added");