<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/subject/Subject.php';
require_once $ROOT . '/app/subject/SubjectService.php';
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/teacher/Teacher.php';

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
    <title>Subjects</title>
</head>

<body>
<button onclick="document.location = '/admin/subject/addSubject.php'">Add Subject</button>
    <div class="subjects">

        <?php foreach ($subjects as $subject) { ?>
            <div class="subject">
                <div class="id"><?php echo $subject->getId(); ?></div>
                <div class="name"><?php echo $subject->getName(); ?></div>
                <div class="grade"><?php echo $subject->getGrade()->getName(); ?></div>
                <div class="teacher"><?php echo $subject->getTeacher()->getEmail(); ?></div>
                <button onclick="document.location = '/admin/subject/deleteSubject.php?id=<?php echo $subject->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/subject/updateSubject.php?id=<?php echo $subject->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>