<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';
require_once $ROOT . '/app/lesson/Lesson.php';
require_once $ROOT . '/app/file/FileDirectory.php';
require_once $ROOT . '/app/file/File.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$assignmentService = new AssignmentService();
$assignments = $assignmentService->getAssignments();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments</title>
</head>

<body>
    <button onclick="document.location = '/admin/assignment/addAssignment.php'">Add Assignment</button>
    <div class="assignments">

        <?php foreach ($assignments as $assignment) { ?>
            <div class="assignment">
                <div class="id"><?php echo $assignment->getId(); ?></div>
                <div class="name"><?php echo $assignment->getName(); ?></div>
                <div class="file"><?php echo $assignment->getFile(); ?></div>
                <img src="<?php echo $assignment->getFile(); ?>" alt="">
                <div class="lesson"><?php echo $assignment->getLesson()->getName(); ?></div>
                <button onclick="document.location = '/admin/assignment/deleteAssignment.php?id=<?php echo $assignment->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/assignment/updateAssignment.php?id=<?php echo $assignment->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>