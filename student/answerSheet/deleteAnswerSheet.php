<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';

$jwtService = jwt_start(['student_role']);

$answerSheetService = new AnswerSheetService();
$answerSheetService->delete($_GET['id']);
echo ("delete Successfull");
header('Location: /student/answerSheet/answerSheet.php?link=answerSheet');


?>