<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/officer/OfficerService.php";

$token = $_GET['token'];
$email = $_GET['email'];

$officerService = new OfficerService();
$officerService->verify($email, $token);
echo ("sucessfully verified");