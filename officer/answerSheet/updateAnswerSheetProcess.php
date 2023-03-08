<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';

session_start();

$answerSheetId = $_GET['id'];
$answerSheetName = $_POST['name'];
$answerSheetFile = $_FILES['file'];

$answerSheetService = new AnswerSheetService();
$answerSheetService->setFile($answerSheetFile);
$answerSheetService->upload();
$answerSheetService->update($answerSheetId, $answerSheetName, $answerSheetFile);
echo ("update Successfull");

?>