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
                    <div class="filters">
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
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subjects as $subject) { ?>
                                    <tr>
                                        <td><?php echo $subject->getId(); ?></td>
                                        <td><?php echo $subject->getName(); ?></td>
                                        <td><?php echo $subject->getGrade()->getName(); ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
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