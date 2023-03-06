<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/admin/Admin.php';
require_once $ROOT . '/app/admin/AdminService.php';

session_start();

$adminService = new AdminService();
$adminService->delete($_GET['id']);
echo ("delete Successfull");

?>