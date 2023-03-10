<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/lesson/LessonService.php';

$jwtService = jwt_start(['teacher_role']);
echo $jwtService->getUsername() . "<br>";

$lessonService = new LessonService();
$lessons = $lessonService->getLessonsByTeacherUsername($jwtService->getUsername());

echo var_dump($lessons);