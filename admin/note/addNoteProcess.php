<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/NoteService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$noteName = $_POST['name'];
if (empty($noteName)) {
    die('Please enter note name');
}

$lessonId = $_POST['lesson'];
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
header('Location: /admin/note/note.php?link=note');