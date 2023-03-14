<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$lessonService = new LessonService();
$lessons = $lessonService->getLessons();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | </title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="addAssignmentProcess.php?link=assignment" method="post" enctype="multipart/form-data">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="lesson">Lesson</label>
                            <select name="lesson" id="lesson" placeholder="Select Lesson">
                                <?php foreach ($lessons as $lesson) { ?>
                                    <option value="<?php echo $lesson->getId(); ?>"><?php echo $lesson->getName(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="file">File</label>
                            <input type="file" name="file" placeholder="Assignment File" id="file">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Add Assignment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>