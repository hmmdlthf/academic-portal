<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/student/Student.php';

$jwtService = jwt_start(['officer_role']);

$studentService = new StudentService();
$student = $studentService->getStudentById($_GET['id']);

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
                <form action="updateStudentProcess.php?id=<?php echo $student->getId() ?>" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="email">Email</label>
                            <input type="text" name="email" placeholder="Student email" id="email" value="<?php echo $student->getEmail(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update Student</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/officer/js/scripts.php' ?>
</body>