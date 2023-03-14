<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';
require_once $ROOT . '/app/student/StudentService.php';

$jwtService = jwt_start(['student_role']);

$grades = (new StudentService())->getGradesByStudentUsername($jwtService->getUsername());
echo $grades;