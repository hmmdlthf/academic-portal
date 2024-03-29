<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$gradeService = new GradeService();
$grades = $gradeService->getGrades();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades</title>
</head>

<body>
    <button onclick="document.location = '/admin/grade/addGrade.php'">Add Grade</button>
    <div class="grades">

        <?php foreach ($grades as $grade) { ?>
            <div class="grade">
                <div class="id"><?php echo $grade->getId(); ?></div>
                <div class="name"><?php echo $grade->getName(); ?></div>
                <button onclick="document.location = '/admin/grade/deleteGrade.php?id=<?php echo $grade->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/grade/updateGrade.php?id=<?php echo $grade->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>