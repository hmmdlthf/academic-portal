<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/student/StudentService.php";

$token = $_GET['token'];
$email = $_GET['email'];

$studentService = new StudentService();
$studentService->verify($email, $token);
echo ("sucessfully verified");