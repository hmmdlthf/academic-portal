<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/jwt/JwtProtected.php';
$jwtService = jwt_start(['student_role']);

require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';

session_start();

$studentService = new StudentService();
$studentId = $studentService->getStudentByUsername($jwtService->getUsername())->getId();
$studentService->update( $studentId , $_POST['fname'], $_POST['lname'], $_POST['address'], $_POST['phone'], $_POST['nic'], $_POST['title'], $_POST['dob'], $_POST['gender'], $_POST['marital_status'], $_POST['cityId']);
echo ("update Successfull");

?>