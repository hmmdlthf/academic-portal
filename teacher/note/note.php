<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/note/NoteService.php';

$jwtService = jwt_start(['teacher_role']);

$notes = (new NoteService())->getNotesByTeacherUsername($jwtService->getUsername());

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
                <?php if (count($notes) > 0) { ?>
                    <div class="table">
                        <div class="table__head">
                            <div class="field__id">Id</div>
                            <div class="field__name">Name</div>
                            <div class="field__file">File</div>
                            <div class="field__lesson">Lesson</div>
                        </div>
                        <div class="table__body">
                            <?php foreach ($notes as $note) { ?>
                                <div class="table__row">
                                    <div class="data__id"><?php echo $note->getId(); ?></div>
                                    <div class="data__name"><?php echo $note->getName(); ?></div>
                                    <div class="data__file">
                                        <a href="<?php echo $note->getFile(); ?>">Download</a>    
                                    </div>
                                    <div class="data__lesson"><?php echo $note->getLesson()->getName(); ?></div>
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

    <?php require $ROOT . '/teacher/js/scripts.php' ?>
</body>

</html>