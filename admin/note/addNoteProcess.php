<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/NoteService.php';

session_start();

$noteName = $_POST['name'];
if (empty($noteName)) {
    die('Please enter note name');
}

$lessonId = $_POST['lessonId'];
if (empty($lessonId)) {
    die('Please select parent lesson');
}

$noteFile = $_FILES['file'];
if (empty($noteFile)) {
    die('Please upload file');
}


$noteService = new NoteService();
$noteService->setFile($noteFile);
$noteService->upload();
$noteService->save($noteName, $lessonId);
echo ("successfull added");