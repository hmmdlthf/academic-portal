<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';

session_start();

$assignmentService = new AssignmentService();
$assignments = $assignmentService->getAssignments();

$studentService = new StudentService();
$students = $studentService->getStudents();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add AnswerSheet</title>
</head>
<body>
    <form action="addAnswerSheetProcess.php" method="post" enctype="multipart/form-data">
        <select name="assignmentId" id="" placeholder="Select Assignment">
            <?php foreach($assignments as $assignment) { ?>
                <option value="<?php echo $assignment->getId(); ?>"><?php echo $assignment->getId(); ?></option>
            <?php } ?>
        </select>
        <select name="studentId" id="" placeholder="Select Student">
            <?php foreach($students as $student) { ?>
                <option value="<?php echo $student->getId(); ?>"><?php echo $student->getEmail(); ?></option>
            <?php } ?>
        </select>
        <input type="file" name="file" placeholder="AnswerSheet File" id="file">
        <button type="submit">Add AnswerSheet</button>
    </form>
</body>
</html>