<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';

$jwtService = jwt_start(['officer_role']);

$studentService = new StudentService();
$studentService->delete($_GET['id']);
echo ("delete Successfull");
header('Location: /officer/student/student.php?link=student');
