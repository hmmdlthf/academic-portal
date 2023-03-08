<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';

session_start();

$answerSheetId = $_GET['id'];
$answerSheetMarks = $_POST['marks'];

$answerSheetService = new AnswerSheetService();
$answerSheetService->updateMarks($answerSheetId, $answerSheetMarks);
echo ("update Successfull");

?>