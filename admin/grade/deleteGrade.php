<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';

session_start();

$gradeService = new GradeService();
$gradeService->delete($_GET['id']);
echo ("delete Successfull");

?>