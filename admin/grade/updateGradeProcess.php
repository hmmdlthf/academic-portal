<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';

$jwtService = jwt_start(['admin_role']);

$gradeId = $_GET['id'];
if (empty($gradeId)) {
    die('Please enter grade id');
}

$gradeName = $_POST['name'];
if (empty($gradeName)) {
    die('Please enter grade name');
}

$gradeService = new GradeService();
$gradeService->update($_GET['id'], $_POST['name']);
echo ("update Successfull");
header('Location: /admin/grade/grade.php?link=grade');

?>