<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';
require_once $ROOT . '/app/city/CityService.php';
require_once $ROOT . '/app/state/StateService.php';
require_once $ROOT . '/app/country/CountryService.php';
require_once $ROOT . '/app/grade/GradeService.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/note/NoteService.php';
require_once $ROOT . '/app/officer/OfficerService.php';
require_once $ROOT . '/app/payment/PaymentService.php';
require_once $ROOT . '/app/state/StateService.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/subject/SubjectService.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

jwt_start(['admin_role']);

$answerSheetCount = (new AnswerSheetService())->count();
$assignmentCount = (new AssignmentService())->count();
$cityCount = (new CityService())->count();
$stateCount = (new StateService())->count();
$countryCount = (new CountryService())->count();
$gradeCount = (new GradeService())->count();
$lessonCount = (new LessonService())->count();
$noteCount = (new NoteService())->count();
$officerCount = (new OfficerService())->count();
$paymentCount = (new PaymentService())->count();
$studentCount = (new StudentService())->count();
$subjectCount = (new SubjectService())->count();
$teacherCount = (new TeacherService())->count();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Acedemy | Dashboard</title>

    <?php require $ROOT . '/admin/head/head.php'; ?>
</head>

<body>
    <div class="main">
    <?php require $ROOT . '/admin/menu.php'; ?>
        
        <div class="body">
        <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <div class="small__cards">
                    <div class="card small__card">
                        <div class="title">Answer Sheets</div>
                        <div class="count"><?php echo $answerSheetCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Assignments</div>
                        <div class="count"><?php echo $assignmentCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Cities</div>
                        <div class="count"><?php echo $cityCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">States</div>
                        <div class="count"><?php echo $stateCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Countries</div>
                        <div class="count"><?php echo $countryCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Grades</div>
                        <div class="count"><?php echo $gradeCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Lessons</div>
                        <div class="count"><?php echo $lessonCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Notes</div>
                        <div class="count"><?php echo $Count;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Officers</div>
                        <div class="count"><?php echo $officerCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Payments</div>
                        <div class="count"><?php echo $paymentCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Students</div>
                        <div class="count"><?php echo $studentCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Subjects</div>
                        <div class="count"><?php echo $subjectCount;?></div>
                    </div>
                    <div class="card small__card">
                        <div class="title">Teachers</div>
                        <div class="count"><?php echo $teacherCount;?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php require $ROOT . '/admin/js/scripts.php'; ?>
</body>

</html>