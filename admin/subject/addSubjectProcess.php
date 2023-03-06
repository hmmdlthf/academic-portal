<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/subject/SubjectService.php';

session_start();

$subjectName = $_POST['name'];
if (empty($subjectName)) {
    die('Please enter subject name');
}

$gradeId = $_POST['gradeId'];
if (empty($gradeId)) {
    die('Please select parent grade');
}

$teacherId = $_POST['teacherId'];
if (empty($teacherId)) {
    die('Please select parent teacher');
}

$subjectService = new SubjectService();
$subjectService->save($subjectName, $gradeId, $teacherId);
echo ("successfull added");