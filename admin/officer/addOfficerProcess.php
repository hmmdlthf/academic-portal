<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/officer/OfficerService.php';

session_start();

$email = $_POST['email'];
if (empty($email)) {
    die('Please enter email');
}

$officerService = new OfficerService();
$officerService->save($email);
echo ("successfull added");