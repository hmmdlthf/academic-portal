<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/city/CityService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

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
header('Location: /admin/city/city.php?link=city');