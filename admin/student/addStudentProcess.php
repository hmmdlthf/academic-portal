<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';

session_start();

$email = $_POST['email'];
if (empty($email)) {
    die('Please enter email');
}

$officerId = $_POST['officerId'];
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