<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/subject/SubjectService.php';

$jwtService = jwt_start(['admin_role']);

$lessonService = new LessonService();
$lesson = $lessonService->getLessonById($_GET['id']);

$subjects = (new SubjectService())->getSubjects();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Lesson</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="updateLessonProcess.php?id=<?php echo $lesson->getId() ?>" method="post" enctype="multipart/form-data">
                    <div class="form__group">
                        <div class="form__control">
                            <select name="subject" id="subject">
                                <?php foreach ($subjects as $subject) { ?>
                                    <?php if ($subject->getId() == $lesson->getSubject()->getId()) { ?>
                                        <option value="<?php echo $subject->getId(); ?>" selected><?php echo $subject->getName(); ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $subject->getId(); ?>"><?php echo $subject->getName(); ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="name"></label>
                            <input type="text" name="name" id="name" placeholder="Lesson Name" value="<?php echo $lesson->getName() ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">update Lesson</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>