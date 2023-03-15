<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/subject/SubjectService.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/note/NoteService.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

$jwtService = jwt_start(['student_role']);

$username = $jwtService->getUsername();
$subjectCount = count((new SubjectService())->getSubjectsByStudentUsername($username));
$lessonCount = count((new LessonService())->getLessonsByStudentUsername($username));
$noteCount = count((new NoteService())->getNotesByStudentUsername($username));
$answerSheetCount = count((new AnswerSheetService())->getAnswerSheetsByStudentUsername($username));
$assignmentCount = count((new AssignmentService())->getAssignmentsByStudentUsername($username));


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Acedemy | Dashboard</title>

    <?php require $ROOT . '/student/head/head.php'; ?>
    <link rel="stylesheet" href="/scss/grades.css">
</head>

<body>
    <div class="main">
        <?php require $ROOT . '/student/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/student/header.php'; ?>
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
                <div class="big__cards">
                    <div class="card grades__card">
                        <div class="card__title">Select Grade</div>
                        <div class="grades">
                            <div class="grade">
                                <div class="subtitle">Grade</div>
                                <div class="status">Current</div>
                                <div class="grade__name">GradeA</div>
                                <div class="footer">
                                    <div class="footer__text">Subjects: 10</div>
                                </div>
                            </div>
                            <div class="grade">
                                <div class="subtitle">Grade</div>
                                <div class="status">Old</div>
                                <div class="grade__name">GradeA</div>
                                <div class="footer">
                                    <div class="footer__text">Subjects: 10</div>
                                </div>
                            </div>
                            <div class="grade">
                                <div class="subtitle">Grade</div>
                                <div class="status">Old</div>
                                <div class="grade__name">GradeA</div>
                                <div class="footer">
                                    <div class="footer__text">Subjects: 10</div>
                                </div>
                            </div>
                            <div class="grade">
                                <div class="subtitle">Grade</div>
                                <div class="status">Old</div>
                                <div class="grade__name">GradeA</div>
                                <div class="footer">
                                    <div class="footer__text">Subjects: 10</div>
                                </div>
                            </div>
                            <div class="grade">
                                <div class="subtitle">Grade</div>
                                <div class="status">Old</div>
                                <div class="grade__name">GradeA</div>
                                <div class="footer">
                                    <div class="footer__text">Subjects: 10</div>
                                </div>
                            </div>
                            <div class="grade">
                                <div class="subtitle">Grade</div>
                                <div class="status">Old</div>
                                <div class="grade__name">GradeA</div>
                                <div class="footer">
                                    <div class="footer__text">Subjects: 10</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card grades__card"></div>
                </div>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/student/js/scripts.php'; ?>
</body>

</html>