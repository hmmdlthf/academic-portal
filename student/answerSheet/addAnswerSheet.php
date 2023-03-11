<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';
require_once $ROOT . '/app/assignment/Assignment.php';

$jwtService = jwt_start(['student_role']);

$assignmentService = new AssignmentService();
$assignments = $assignmentService->getAssignmentsByStudentUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Answer sheet</title>

    <?php require $ROOT . '/student/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/student/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/student/header.php'; ?>
            <div class="body__content">
                <form action="addAnswerSheetProcess.php?link=answerSheet" method="post" enctype="multipart/form-data">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="lessonId"></label>
                            <select name="assignmentId" id="" placeholder="Select Assignment">
                                <?php foreach ($assignments as $assignment) { ?>
                                    <option value="<?php echo $assignment->getId(); ?>"><?php echo $assignment->getId(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="file"></label>
                            <input type="file" name="file" placeholder="AnswerSheet File" id="file">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Add Answer Sheet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/student/js/scripts.php' ?>
</body>