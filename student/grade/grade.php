<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';
require_once $ROOT . '/app/student/StudentService.php';

$jwtService = jwt_start(['student_role']);

var_dump((new StudentService())->getGradesByStudentUsername($jwtService->getUsername()))

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Grade</title>

    <?php require $ROOT . '/student/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/student/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/student/header.php'; ?>
            <div class="body__content">
                <?php if (count($grades) > 0) { ?>
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
                                    <th>Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($grades as $grade) { ?>
                                    <tr>
                                        <td><?php echo $grade->getId(); ?></td>
                                        <td><?php echo $grade->getName(); ?></td>
                                        <td><?php echo $grade->getGrade()->getName(); ?></td>
                                        <td><?php echo $grade->getTeacher()->getEmail(); ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no Grades Assigned
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/student/js/scripts.php' ?>
</body>

</html>