<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/lesson/LessonService.php';

$jwtService = jwt_start(['student_role']);

$lessons = (new LessonService())->getLessonsByStudentUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Lesson</title>

    <?php require $ROOT . '/student/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/student/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/student/header.php'; ?>
            <div class="body__content">
                <?php if (count($lessons) > 0) { ?>
                    <div class="filters">
                        <div class="form__group">
                            <div class="form__control">
                                <select name="subject" id="subject">
                                    <option value="">SubjectA1</option>
                                    <option value="">SubjectA2</option>
                                    <option value="">SubjectA3</option>
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
                                    <th>Subject</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lessons as $lesson) { ?>
                                    <tr>
                                        <td><?php echo $lesson->getId(); ?></td>
                                        <td><?php echo $lesson->getName(); ?></td>
                                        <td><?php echo $lesson->getSubject()->getName(); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no lessons found in subjects
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/student/js/scripts.php' ?>
</body>

</html>