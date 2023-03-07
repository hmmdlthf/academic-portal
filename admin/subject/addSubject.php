<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

session_start();

$gradeService = new GradeService();
$grades = $gradeService->getGrades();

$teacherService = new TeacherService();
$teachers = $teacherService->getTeachers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
</head>
<body>
    <form action="addSubjectProcess.php" method="post">
        <select name="gradeId" id="" placeholder="Select Grade">
            <?php foreach($grades as $grade) { ?>
                <option value="<?php echo $grade->getId(); ?>"><?php echo $grade->getName(); ?></option>
            <?php } ?>
        </select>
        <select name="teacherId" id="" placeholder="Select Teacher">
            <?php foreach($teachers as $teacher) { ?>
                <option value="<?php echo $teacher->getId(); ?>"><?php echo $teacher->getEmail(); ?></option>
            <?php } ?>
        </select>
        <input type="text" name="name" placeholder="Subject Name" id="name">
        <button type="submit">Add Subject</button>
    </form>
</body>
</html>