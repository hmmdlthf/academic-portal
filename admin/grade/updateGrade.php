<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';

session_start();
$gradeService = new GradeService();
$grade = $gradeService->getGradeById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Grade</title>
</head>
<body>
    <form action="updateGradeProcess.php?id=<?php echo $grade->getId() ?>" method="post">
        <input type="text" name="name" placeholder="Grade Name" id="name" value="<?php echo $grade->getName() ?>">
        <button type="submit">update Grade</button>
    </form>
</body>
</html>