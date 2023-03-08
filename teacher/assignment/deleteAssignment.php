<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

session_start();

$assignmentService = new AssignmentService();
$assignmentService->delete($_GET['id']);
echo ("delete Successfull");

?>