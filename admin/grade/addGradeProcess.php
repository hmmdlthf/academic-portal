<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/GradeService.php';

session_start();

$gradeName = $_POST['name'];
if (empty($gradeName)) {
    die('Please enter grade name');
}

$gradeService = new GradeService();
$gradeService->save($gradeName);