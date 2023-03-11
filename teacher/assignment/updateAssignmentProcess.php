<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

session_start();

$assignmentId = $_GET['id'];
$assignmentFile = $_FILES['file'];

$assignmentService = new AssignmentService();
$assignmentService->setFile($assignmentFile);
$assignmentService->upload();
$assignmentService->update($assignmentId, $assignmentFile);
echo ("update Successfull");
header('Location: /teacher/assignment/assignment.php?link=assignment');


?>