<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/country/CountryService.php';

session_start();

$countryName = $_POST['name'];
if (empty($countryName)) {
    die('Please enter country name');
}

$countryService = new CountryService();
$countryService->save($countryName);
echo ("successfull added");