<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/grade/GradeService.php';

$jwtService = jwt_start(['admin_role']);

$gradeName = $_POST['name'];
if (empty($gradeName)) {
    die('Please enter grade name');
}

$gradeService = new GradeService();
$gradeService->save($gradeName);
echo ("successfull added");
header('Location: /admin/grade/grade.php?link=grade');