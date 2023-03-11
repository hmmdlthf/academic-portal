<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/student/StudentService.php';

$jwtService = jwt_start(['officer_role']);


$email = $_POST['email'];
if (empty($email)) {
    die('Please enter email');
}

$studentService = new StudentService();
$studentService->save($email, $jwtService->getUsername());
echo ("successfull added");
header('Location: /officer/student/student.php?link=student');
