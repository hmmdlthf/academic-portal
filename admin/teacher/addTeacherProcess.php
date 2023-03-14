<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/teacher/TeacherService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$email = $_POST['email'];
if (empty($email)) {
    die('Please enter email');
}

$teacherService = new TeacherService();
$teacherService->save($email);
echo ("successfull added");
header('Location: /admin/teacher/teacher.php?link=teacher');