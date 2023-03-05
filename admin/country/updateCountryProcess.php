<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/country/Country.php';
require_once $ROOT . '/app/country/CountryService.php';

session_start();

$countryService = new CountryService();
$countryService->update($_GET['id'], $_POST['name']);
echo ("update Successfull");

?>