<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

session_start();

$lessonService = new LessonService();
$lessons = $lessonService->getLessons();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Assignment</title>
</head>
<body>
    <form action="addAssignmentProcess.php" method="post" enctype="multipart/form-data">
        <select name="lessonId" id="" placeholder="Select Lesson">
            <?php foreach($lessons as $lesson) { ?>
                <option value="<?php echo $lesson->getId(); ?>"><?php echo $lesson->getName(); ?></option>
            <?php } ?>
        </select>
        <input type="text" name="name" placeholder="Assignment Name" id="name">
        <input type="file" name="file" placeholder="Assignment File" id="file">
        <button type="submit">Add Assignment</button>
    </form>
</body>
</html>