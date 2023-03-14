<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/file/FileDirectory.php';
require_once $ROOT . '/app/file/File.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$answerSheetService = new AnswerSheetService();
$answerSheets = $answerSheetService->getAnswerSheets();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnswerSheets</title>
</head>

<body>
    <button onclick="document.location = '/admin/answerSheet/addAnswerSheet.php'">Add AnswerSheet</button>
    <div class="answerSheets">

        <?php foreach ($answerSheets as $answerSheet) { ?>
            <div class="answerSheet">
                <div class="id"><?php echo $answerSheet->getId(); ?></div>
                <div class="file"><?php echo $answerSheet->getFile(); ?></div>
                <img src="<?php echo $answerSheet->getFile(); ?>" alt="">
                <div class="assignment"><?php echo $answerSheet->getAssignment()->getName(); ?></div>
                <div class="student"><?php echo $answerSheet->getStudent()->getEmail(); ?></div>
                <button onclick="document.location = '/admin/answerSheet/deleteAnswerSheet.php?id=<?php echo $answerSheet->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/answerSheet/updateAnswerSheet.php?id=<?php echo $answerSheet->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>