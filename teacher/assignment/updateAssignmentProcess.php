<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

session_start();

$assignmentId = $_GET['id'];
$assignmentName = $_POST['name'];
$assignmentFile = $_FILES['file'];

$assignmentService = new AssignmentService();
$assignmentService->setFile($assignmentFile);
$assignmentService->upload();
$assignmentService->update($assignmentId, $assignmentName, $assignmentFile);
echo ("update Successfull");

?>