<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/admin/AdminService.php';

session_start();

$email = $_POST['email'];
if (empty($email)) {
    die('Please enter email');
}

$adminService = new AdminService();
$adminService->save($email);
echo ("successfull added");