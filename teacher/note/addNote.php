<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/note/NoteService.php';
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/note/Note.php';

$jwtService = jwt_start(['teacher_role']);

$lessonService = new LessonService();
$lessons = $lessonService->getLessonsByTeacherUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Note</title>

    <?php require $ROOT . '/teacher/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/teacher/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/teacher/header.php'; ?>
            <div class="body__content">
                <form action="addNoteProcess.php" method="post" enctype="multipart/form-data">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="lessonId"></label><select name="lessonId" id="lessonId" placeholder="Select Lesson">
                                <?php foreach ($lessons as $lesson) { ?>
                                    <option value="<?php echo $lesson->getId(); ?>"><?php echo $lesson->getName(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="name"></label><input type="text" name="name" placeholder="Note Name" id="name">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="file"></label><input type="file" name="file" placeholder="Note File" id="file">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Add Note</button>
                        </div>
                    </div>




                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/teacher/js/scripts.php' ?>
</body>