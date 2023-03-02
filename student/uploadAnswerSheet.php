<?php
session_start();

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/file/File.php';
require_once $ROOT . '/app/file/ImageDirectory.php';
require_once $ROOT . '/app/answer_sheet/AnswerSheetService.php';

$file = $_FILES['fileToUpload'];
$targetDir = '/uploads/images/';

$answerSheetService = new AnswerSheetService();
$answerSheetService->setFile($file);
$answerSheetService->upload();