<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/Note.php';
require_once $ROOT . '/app/note/NoteService.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';

$jwtService = jwt_start(['teacher_role']);

$noteId = $_GET['id'];
$noteName = $_POST['name'];
$noteFile = $_FILES['file'];

$noteService = new NoteService();

if (!empty($noteFile['name'])) {
    $noteService->setFile($noteFile);
    $noteService->upload();
}

$noteService->update($noteId, $noteName, $noteFile);
echo ("update Successfull");
header('Location: /teacher/note/note.php?link=note');

?>