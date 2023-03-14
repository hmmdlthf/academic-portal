<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$assignmentId = $_POST['assignment'];
if (empty($assignmentId)) {
    die('Please select parent assignment');
}

$studentId = $_POST['student'];
if (empty($studentId)) {
    die('Please select student');
}


$answerSheetFile = $_FILES['file'];
if (empty($answerSheetFile)) {
    die('Please upload file');
}


$answerSheetService = new AnswerSheetService();
$answerSheetService->setFile($answerSheetFile);
$answerSheetService->upload();
$answerSheetService->save($assignmentId, $studentId);
echo ("successfull added");
header('Location: /admin/answersheet/answerSheet.php?link=answerSheet');