<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';

$jwtService = jwt_start(['teacher_role']);

$assignmentService = new AssignmentService();
$assignmentService->delete($_GET['id']);
echo ("delete Successfull");
header('Location: /teacher/assignment/assignment.php?link=assignment');

?>