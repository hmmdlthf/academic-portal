<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/jwt/JwtProtected.php';
$jwtService = jwt_start(['officer_role']);

require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';

session_start();

$officerService = new OfficerService();
$officerId = $officerService->getOfficerByUsername($jwtService->getUsername())->getId();
$officerService->update( $officerId , $_POST['fname'], $_POST['lname'], $_POST['address'], $_POST['phone'], $_POST['nic'], $_POST['title'], $_POST['dob'], $_POST['gender'], $_POST['marital_status'], $_POST['cityId']);
echo ("update Successfull");
header('Location: /officer/profile/profile.php?link=profile')

?>