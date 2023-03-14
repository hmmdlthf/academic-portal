<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/country/Country.php';
require_once $ROOT . '/app/country/CountryService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$countryService = new CountryService();
$countryService->delete($_GET['id']);
echo ("delete Successfull");
header('Location: /admin/country/country.php?link=country');

?>