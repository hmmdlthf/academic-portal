<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/lesson/LessonService.php';

session_start();
$lessonService = new LessonService();
$lesson = $lessonService->getLessonById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Lesson</title>
</head>
<body>
    <form action="updateLessonProcess.php?id=<?php echo $lesson->getId() ?>" method="post">
        <input type="text" name="name" placeholder="Lesson Name" id="name" value="<?php echo $lesson->getName() ?>">
        <button type="submit">update Lesson</button>
    </form>
</body>
</html>