<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/subject/Subject.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lessons</title>
</head>

<body>
<button onclick="document.location = '/admin/lesson/addLesson.php'">Add Lesson</button>
    <div class="lessons">

        <?php foreach ($lessons as $lesson) { ?>
            <div class="lesson">
                <div class="id"><?php echo $lesson->getId(); ?></div>
                <div class="name"><?php echo $lesson->getName(); ?></div>
                <div class="subject"><?php echo $lesson->getSubject()->getName(); ?></div>
                <button onclick="document.location = '/admin/lesson/deleteLesson.php?id=<?php echo $lesson->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/lesson/updateLesson.php?id=<?php echo $lesson->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>