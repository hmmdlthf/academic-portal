<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/subject/SubjectService.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/note/NoteService.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

$jwtService = jwt_start(['teacher_role']);

$username = $jwtService->getUsername();
$subjectCount = count((new SubjectService())->getSubjectsByTeacherUsername($username));
$lessonCount = count((new LessonService())->getLessonsByTeacherUsername($username));
$noteCount = count((new NoteService())->getNotesByTeacherUsername($username));
$answerSheetCount = count((new AnswerSheetService())->getAnswerSheetsByTeacherUsername($username));
$assignmentCount = count((new AssignmentService())->getAssignmentsByTeacherUsername($username));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Acedemy | Dashboard</title>

    <?php require $ROOT . '/teacher/head/head.php'; ?>
</head>

<body>
    <div class="main">
        <?php require $ROOT . '/teacher/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/teacher/header.php'; ?>
            <div class="body__content">
                <div class="small__cards">
                    <div class="card small__card">
                        <div class="title">Answer Sheets</div>
                        <div class="count"><?php echo $answerSheetCount; ?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Assignments</div>
                        <div class="count"><?php echo $assignmentCount; ?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Lessons</div>
                        <div class="count"><?php echo $lessonCount; ?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Notes</div>
                        <div class="count"><?php echo $Count; ?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Subjects</div>
                        <div class="count"><?php echo $subjectCount; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/teacher/js/scripts.php'; ?>
</body>

</html>