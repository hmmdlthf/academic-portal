<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/Note.php';
require_once $ROOT . '/app/note/NoteService.php';

session_start();

$noteService = new NoteService();
$noteService->delete($_GET['id']);
echo ("delete Successfull");

?>