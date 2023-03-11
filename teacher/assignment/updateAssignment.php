<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';
require_once $ROOT . '/app/assignment/Assignment.php';

$jwtService = jwt_start(['teacher_role']);

$assignmentService = new AssignmentService();
$assignment = $assignmentService->getAssignmentById($_GET['id']);

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
                <form action="updateAssignmentProcess.php?id=<?php echo $assignment->getId() ?>" method="post" enctype="multipart/form-data">
                    <a href="<?php echo $assignment->getFile(); ?>" download="">Download Preview</a>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="file"></label>
                            <input type="file" name="file" placeholder="Assignment File" id="file" value="<?php echo $assignment->getFile(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update Assignment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/teacher/js/scripts.php' ?>
</body>