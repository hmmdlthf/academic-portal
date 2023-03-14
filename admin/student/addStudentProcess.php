<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$email = $_POST['email'];
if (empty($email)) {
    die('Please enter email');
}

$officerId = $_POST['officer'];
if (empty($officerId)) {
    die('Please select officer');
}

$officerService = new OfficerService();
$officer = $officerService->getOfficerById($officerId);

if ($officer == false) {
    die("no officer with that id");
}

$studentService = new StudentService();
$studentService->save($email, $officer->getUsername());
echo ("successfull added");
header('Location: /admin/student/student.php?link=student');