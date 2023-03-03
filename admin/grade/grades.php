<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/GradeService.php';

session_start();

$gradeService = new GradeService();
$grades = $gradeService->getGrades();
var_dump($grades);

foreach($grades as $grade) {
    echo $grade->getId();
    echo $grade->getName();
    echo ("<br>");
}