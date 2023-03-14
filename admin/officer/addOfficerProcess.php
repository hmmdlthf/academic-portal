<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/officer/OfficerService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$email = $_POST['email'];
if (empty($email)) {
    die('Please enter email');
}

$officerService = new OfficerService();
$officerService->save($email);
echo ("successfull added");
header('Location: /adim/officer/officer.php?link=officer');