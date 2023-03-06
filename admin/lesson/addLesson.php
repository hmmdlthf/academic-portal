<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/subject/Subject.php';
require_once $ROOT . '/app/subject/SubjectService.php';
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/lesson/LessonService.php';

session_start();

$subjectService = new SubjectService();
$subjects = $subjectService->getSubjects();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lesson</title>
</head>
<body>
    <form action="addLessonProcess.php" method="post">
        <select name="subjectId" id="" placeholder="Select Subject">
            <?php foreach($subjects as $subject) { ?>
                <option value="<?php echo $subject->getId(); ?>"><?php echo $subject->getName(); ?></option>
            <?php } ?>
        </select>
        <input type="text" name="name" placeholder="Lesson Name" id="name">
        <button type="submit">Add Lesson</button>
    </form>
</body>
</html>