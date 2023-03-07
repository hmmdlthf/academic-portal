<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';

session_start();

$studentService = new StudentService();
$studentService->delete($_GET['id']);
echo ("delete Successfull");

?>