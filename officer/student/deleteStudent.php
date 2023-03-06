<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

session_start();

$teacherService = new TeacherService();
$teacherService->delete($_GET['id']);
echo ("delete Successfull");

?>