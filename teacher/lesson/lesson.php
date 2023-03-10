<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/lesson/LessonService.php';

$jwtService = jwt_start(['teacher_role']);

$lessons = (new LessonService())->getLessonsByTeacherUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Lesson</title>

    <?php require $ROOT . '/teacher/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/teacher/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/teacher/header.php'; ?>
            <div class="body__content">
                <?php if (count($lessons) > 0) { ?>
                    <div class="filters">
                        
                    </div>
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
                <?php } else { ?>
                    no lessons found in subjects
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/teacher/js/scripts.php' ?>
</body>

</html>