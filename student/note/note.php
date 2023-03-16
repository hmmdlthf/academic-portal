<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/note/NoteService.php';

$jwtService = jwt_start(['student_role']);

$notes = (new NoteService())->getNotesByStudentUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Note</title>

    <?php require $ROOT . '/student/head/head.php' ?>
    <link rel="stylesheet" href="/scss/note.css">

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/student/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/student/header.php'; ?>
            <div class="body__content">
                <?php if (count($notes) > 0) { ?>
                    <div class="filters">
                        <div class="form__group">
                            <div class="form__control">
                                <select name="lesson" id="lesson">
                                    <option value="">Lesson1</option>
                                    <option value="">Lesson2</option>
                                    <option value="">Lesson3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="form__control">
                                <input type="text" name="name" placeholder="Name" id="">
                            </div>
                        </div>
                    </div>
                    <div class="notes__card">
                        <div class="card__title">Select note</div>
                        <div class="notes">
                            <?php foreach ($notes as $note) { ?>
                                <div class="note">
                                    <div class="subtitle">note</div>
                                    <div class="note__name"><?php echo $note->getName(); ?></div>
                                    <div class="lesson__name"><?php echo $note->getLesson()->getName(); ?></div>
                                    <a href="<?php echo $note->getFile(); ?>" download="">Download</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                <?php } else { ?>
                    no notes found in all lessons
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/student/js/scripts.php' ?>
</body>

</html>