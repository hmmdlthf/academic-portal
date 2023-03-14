<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/Note.php';
require_once $ROOT . '/app/note/NoteService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$noteId = $_GET['id'];
$noteName = $_POST['name'];
$noteFile = $_FILES['file'];

$noteService = new NoteService();
$noteService->setFile($noteFile);
$noteService->upload();
$noteService->update($noteId, $noteName, $noteFile);
echo ("update Successfull");
header('Location: /admin/note/note.php?link=note');


?>