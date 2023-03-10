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
                    <div class="items">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>File</th>
                                    <th>Lesson</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notes as $note) { ?>
                                    <tr>
                                        <td><?php echo $note->getId(); ?></td>
                                        <td><?php echo $note->getName(); ?></td>
                                        <td><a href="<?php echo $note->getFile(); ?>" download="">Download</a></td>
                                        <td><?php echo $note->getLesson()->getName(); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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