<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/teacher/TeacherService.php';

session_start();

$email = $_POST['email'];
if (empty($email)) {
    die('Please enter email');
}

$teacherService = new TeacherService();
$teacherService->save($email);
echo ("successfull added");