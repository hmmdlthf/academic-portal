<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';

session_start();

$answerSheetService = new AnswerSheetService();
$answerSheetService->delete($_GET['id']);
echo ("delete Successfull");

?>