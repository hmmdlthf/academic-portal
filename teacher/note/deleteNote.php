<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/Note.php';
require_once $ROOT . '/app/note/NoteService.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';

$jwtService = jwt_start(['teacher_role']);

$noteService = new NoteService();
$noteService->delete($_GET['id']);
echo ("delete Successfull");
header('Location: /teacher/note/note.php?link=note');
