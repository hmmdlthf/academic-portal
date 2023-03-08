<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';

session_start();

$assignmentId = $_POST['assignmentId'];
if (empty($assignmentId)) {
    die('Please select parent assignment');
}

$studentId = $_POST['studentId'];
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