<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

session_start();

$teacherService = new TeacherService();
$teacherService->update($_GET['id'], $_POST['fname'], $_POST['lname'], $_POST['address'], (int)$_POST['phone'], $_POST['nic'], $_POST['title'], $_POST['dob'], $_POST['gender'], $_POST['marital_status'], $_POST['cityId']);
echo ("update Successfull");

?>