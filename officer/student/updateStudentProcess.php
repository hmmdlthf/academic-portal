<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';

$jwtService = jwt_start(['officer_role']);

$studentId = $_GET['id'];
$studentEmail = $_POST['email'];

$studentService = new StudentService();

$studentService->update($studentEmail);
echo ("update Successfull");
header('Location: /officer/student/student.php?link=student');

?>