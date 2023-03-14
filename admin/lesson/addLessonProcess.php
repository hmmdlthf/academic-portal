<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/lesson/LessonService.php';

$jwtService = jwt_start(['admin_role']);

$lessonName = $_POST['name'];
if (empty($lessonName)) {
    die('Please enter lesson name');
}

$subjectId = $_POST['subject'];
if (empty($subjectId)) {
    die('Please select subject');
}

$lessonService = new LessonService();
$lessonService->save($lessonName, $subjectId);
echo ("successfull added");
header('Location: /admin/lesson/lesson.php?link=lesson');