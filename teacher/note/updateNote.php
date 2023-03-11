<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/note/NoteService.php';
require_once $ROOT . '/app/note/Note.php';

$jwtService = jwt_start(['teacher_role']);

$noteService = new NoteService();
$note = $noteService->getNoteById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Note</title>

    <?php require $ROOT . '/teacher/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/teacher/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/teacher/header.php'; ?>
            <div class="body__content">
                <form action="updateNoteProcess.php?id=<?php echo $note->getId() ?>" method="post" enctype="multipart/form-data">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="name"></label>
                            <input type="text" name="name" placeholder="Note Name" id="name" value="<?php echo $note->getName(); ?>">
                        </div>
                    </div>
                    <a href="<?php echo $note->getFile(); ?>" download="">Download Preview</a>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="file"></label>
                            <input type="file" name="file" placeholder="Note File" id="file" value="<?php echo $note->getFile(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update Note</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/teacher/js/scripts.php' ?>
</body>