<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/country/Country.php';
require_once $ROOT . '/app/country/CountryService.php';

session_start();

$countryService = new CountryService();
$countryService->delete($_GET['id']);
echo ("delete Successfull");

?>