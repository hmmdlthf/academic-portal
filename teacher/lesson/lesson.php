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
                    <div class="table">
                        <div class="table__head">
                            <div class="field__id">Id</div>
                            <div class="field__name">Name</div>
                            <div class="field__subject">Subject</div>
                        </div>
                        <div class="table__body">
                            <?php foreach ($lessons as $lesson) { ?>
                                <div class="table__row">
                                    <div class="data__id"><?php echo $lesson->getId(); ?></div>
                                    <div class="data__name"><?php echo $lesson->getName(); ?></div>
                                    <div class="data__subject"><?php echo $lesson->getSubject()->getName(); ?></div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                <?php } else { ?>
                    no lessons found in subjects
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/teacher/js/scripts.php' ?>
</body>

</html>