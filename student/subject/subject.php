<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/subject/SubjectService.php';

$jwtService = jwt_start(['student_role']);

$subjects = (new SubjectService())->getSubjectsByStudentUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Subject</title>

    <?php require $ROOT . '/student/head/head.php' ?>
    <link rel="stylesheet" href="/scss/subject.css">

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/student/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/student/header.php'; ?>
            <div class="body__content">
                <?php if (count($subjects) > 0) { ?>
                    <div class="filters">
                        <div class="form__group">
                            <div class="form__control">
                                <input type="text" name="name" placeholder="Name" id="">
                            </div>
                        </div>
                    </div>
                    <div class="subjects__card">
                        <div class="card__title">Select Subject</div>
                        <div class="subjects">
                            <?php foreach ($subjects as $subject) { ?>
                                <div class="subject">
                                    <div class="subtitle">Subject</div>
                                    <div class="subject__name"><?php echo $subject->getName(); ?></div>
                                    <div class="grade__name"><?php echo $subject->getGrade()->getName(); ?></div>
                                    <div class="teacher__name"><?php echo $subject->getTeacher()->getEmail(); ?></div>
                                    <div class="footer">
                                        <div class="footer__text">lessons: <?php echo $subject->getLessonCount(); ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    no Subjects Assigned
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/student/js/scripts.php' ?>
</body>

</html>