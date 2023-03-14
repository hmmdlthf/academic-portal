<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/AssignmentService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$assignmentName = $_POST['name'];
if (empty($assignmentName)) {
    die('Please enter assignment name');
}

$lessonId = $_POST['lesson'];
if (empty($lessonId)) {
    die('Please select parent lesson');
}

$assignmentFile = $_FILES['file'];
if (empty($assignmentFile)) {
    die('Please upload file');
}


$assignmentService = new AssignmentService();
$assignmentService->setFile($assignmentFile);
$assignmentService->upload();
$assignmentService->save($assignmentName, $lessonId);
echo ("successfull added");
header('Location: /admin/assignment/assignment.php?link=assignment');
