<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/note/Note.php';
require_once $ROOT . '/app/note/NoteService.php';

session_start();
$noteService = new NoteService();
$note = $noteService->getNoteById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Note</title>
</head>
<body>
    <form action="updateNoteProcess.php?id=<?php echo $note->getId() ?>" method="post">
        <input type="text" name="name" placeholder="Note Name" id="name" value="<?php echo $note->getName() ?>">
        <input type="file" name="file" placeholder="File" id="file" value="<?php echo $note->getFile() ?>">
        <button type="submit">update Note</button>
    </form>
</body>
</html>