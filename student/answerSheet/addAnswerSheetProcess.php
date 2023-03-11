<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/student/StudentService.php';

$jwtService = jwt_start(['student_role']);

$studentId = (new StudentService())->getStudentByUsername($jwtService->getUsername())->getId();

$assignmentId = $_POST['assignmentId'];
if (empty($assignmentId)) {
    die('Please select parent assignment');
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
header('Location: /student/answerSheet/answerSheet.php?link=answerSheet');
