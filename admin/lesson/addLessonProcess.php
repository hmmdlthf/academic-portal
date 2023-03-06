<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/lesson/LessonService.php';

session_start();

$lessonName = $_POST['name'];
if (empty($lessonName)) {
    die('Please enter lesson name');
}

$subjectId = $_POST['subjectId'];
if (empty($subjectId)) {
    die('Please select parent subject');
}


$lessonService = new LessonService();
$lessonService->save($lessonName, $subjectId);
echo ("successfull added");