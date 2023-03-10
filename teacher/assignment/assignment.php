<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

$jwtService = jwt_start(['teacher_role']);

$assignments = (new AssignmentService())->getAssignmentsByTeacherUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Assignment</title>

    <?php require $ROOT . '/teacher/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/teacher/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/teacher/header.php'; ?>
            <div class="body__content">
                <?php if (count($assignments) > 0) { ?>
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
                                    <th>File</th>
                                    <th>Lesson</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($assignments as $assignment) { ?>
                                    <tr>
                                        <td><?php echo $assignment->getId(); ?></td>
                                        <td><a href="<?php echo $assignment->getFile(); ?>" download="">Download</a></td>
                                        <td><?php echo $assignment->getLesson()->getName(); ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no assignments founded
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/teacher/js/scripts.php' ?>
</body>

</html>