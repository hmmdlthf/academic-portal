<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/note/NoteService.php';

$jwtService = jwt_start(['admin_role']);

$notes = (new NoteService())->getNotes();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Note</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <?php if (count($notes) > 0) { ?>
                    <div class="filters">
                        <div class="form__group">
                            <div class="form__control">
                                <select name="lesson" id="lesson">
                                    <option value="">lesson1</option>
                                    <option value="">lesson2</option>
                                    <option value="">lesson3</option>
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
                                    <th>Lesson</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notes as $note) { ?>
                                    <tr>
                                        <td><?php echo $note->getId(); ?></td>
                                        <td><?php echo $note->getName(); ?></td>
                                        <td><?php echo $note->getLesson()->getName(); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no notes found in notes
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>

</html>