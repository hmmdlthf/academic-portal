<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

session_start();
$assignmentService = new AssignmentService();
$assignment = $assignmentService->getAssignmentById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Assignment</title>
</head>
<body>
    <form action="updateAssignmentProcess.php?id=<?php echo $assignment->getId() ?>" method="post">
        <input type="text" name="name" placeholder="Assignment Name" id="name" value="<?php echo $assignment->getName() ?>">
        <input type="file" name="file" placeholder="File" id="file" value="<?php echo $assignment->getFile() ?>">
        <button type="submit">update Assignment</button>
    </form>
</body>
</html>