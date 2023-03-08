<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/Note.php';
require_once $ROOT . '/app/note/NoteService.php';

session_start();

$noteId = $_GET['id'];
$noteName = $_POST['name'];
$noteFile = $_FILES['file'];

$noteService = new NoteService();
$noteService->setFile($noteFile);
$noteService->upload();
$noteService->update($noteId, $noteName, $noteFile);
echo ("update Successfull");

?>