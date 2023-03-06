<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/jwt/JwtService.php';

$jwt = $_COOKIE['jwt'];

if (!$jwt) {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$jwtService = new JwtService(['officer_role']);
$jwtService->decodeJwtToArray($jwt);

if (!$jwtService->verifyJwt()) // check if the 'exp'(expire) is < than current time - opposite true
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

session_start();

$studentService = new StudentService();
$studentService->delete($_GET['id']);
echo ("delete Successfull");

?>