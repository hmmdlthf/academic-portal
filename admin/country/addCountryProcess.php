<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/country/CountryService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$countryName = $_POST['name'];
if (empty($countryName)) {
    die('Please enter country name');
}

$countryService = new CountryService();
$countryService->save($countryName);
echo ("successfull added");
header('Location: /admin/country/country.php?link=country');