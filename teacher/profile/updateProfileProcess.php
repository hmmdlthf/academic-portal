<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/jwt/JwtProtected.php';
$jwtService = jwt_start(['teacher_role']);

require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

session_start();

$teacherService = new TeacherService();
$teacherId = $teacherService->getTeacherByUsername($jwtService->getUsername())->getId();
$teacherService->update( $teacherId , $_POST['fname'], $_POST['lname'], $_POST['address'], $_POST['phone'], $_POST['nic'], $_POST['title'], $_POST['dob'], $_POST['gender'], $_POST['marital_status'], $_POST['cityId']);
echo ("update Successfull");
header('Location: /teacher/profile/profile.php?link=profile')

?>