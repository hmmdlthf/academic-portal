<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';

session_start();

$gradeService = new GradeService();
$gradeService->update($_GET['id'], $_POST['name']);
echo ("update Successfull");

?>