<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/lesson/LessonService.php';

session_start();

$lessonService = new LessonService();
$lessonService->update($_GET['id'], $_POST['name']);
echo ("update Successfull");

?>