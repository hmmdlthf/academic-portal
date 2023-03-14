<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/subject/SubjectService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$subjectName = $_POST['name'];
if (empty($subjectName)) {
    die('Please enter subject name');
}

$gradeId = $_POST['grade'];
if (empty($gradeId)) {
    die('Please select parent grade');
}

$teacherId = $_POST['teacher'];
if (empty($teacherId)) {
    die('Please select parent teacher');
}

$subjectService = new SubjectService();
$subjectService->save($subjectName, $gradeId, $teacherId);
echo ("successfull added");
header('Location: /admin/subject/subject.php?link=subject');