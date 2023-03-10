<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/subject/SubjectService.php';

$jwtService = jwt_start(['teacher_role']);

$subjects = (new SubjectService())->getSubjectsByTeacherUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Subject</title>

    <?php require $ROOT . '/teacher/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/teacher/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/teacher/header.php'; ?>
            <div class="body__content">
                <?php if (count($subjects) > 0) { ?>
                    <div class="table">
                        <div class="table__head">
                            <div class="field__id">Id</div>
                            <div class="field__name">Name</div>
                            <div class="field__teacher">Teacher</div>
                            <div class="field__grade">Grade</div>
                        </div>
                        <div class="table__body">
                            <?php foreach ($subjects as $subject) { ?>
                                <div class="table__row">
                                    <div class="data__id"><?php echo $subject->getId(); ?></div>
                                    <div class="data__name"><?php echo $subject->getName(); ?></div>
                                    <div class="data__teacher"><?php echo $subject->getTeacher()->getName(); ?></div>
                                    <div class="data__grade"><?php echo $subject->getGrade()->getName(); ?></div>
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

    <?php require $ROOT . '/teacher/js/scripts.php' ?>
</body>

</html>