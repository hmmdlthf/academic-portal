<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/subject/Subject.php';
require_once $ROOT . '/app/subject/SubjectService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$subjectService = new SubjectService();
$subjectService->update($_GET['id'], $_POST['name']);
echo ("update Successfull");
header('Location: /admin/subject/subject.php?link=subject');

?>