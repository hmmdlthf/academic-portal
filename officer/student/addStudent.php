<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/student/Student.php';

$jwtService = jwt_start(['officer_role']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Student</title>

    <?php require $ROOT . '/officer/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/officer/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/officer/header.php'; ?>
            <div class="body__content">
                <form action="addStudentProcess.php" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="email">Email</label>
                            <input type="text" name="email" placeholder="Student Email" id="email">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Register Student</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/officer/js/scripts.php' ?>
</body>