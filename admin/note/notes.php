<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/Note.php';
require_once $ROOT . '/app/note/NoteService.php';
require_once $ROOT . '/app/lesson/Lesson.php';

session_start();

$noteService = new NoteService();
$notes = $noteService->getNotes();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
</head>

<body>
    <div class="notes">

        <?php foreach ($notes as $note) { ?>
            <div class="note">
                <div class="id"><?php echo $note->getId(); ?></div>
                <div class="name"><?php echo $note->getName(); ?></div>
                <div class="lesson"><?php echo $note->getLesson()->getName(); ?></div>
                <button onclick="document.location = '/admin/note/deleteNote.php?id=<?php echo $note->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/note/updateNote.php?id=<?php echo $note->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>