<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';

session_start();

$officerService = new OfficerService();
$officerService->delete($_GET['id']);
echo ("delete Successfull");

?>