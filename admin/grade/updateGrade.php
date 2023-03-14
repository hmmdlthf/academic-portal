<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';

session_start();
$gradeService = new GradeService();
$grade = $gradeService->getGradeById($_GET['id']);

?>


<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';

$jwtService = jwt_start(['admin_role']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Grade</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="updateGradeProcess.php?id=<?php echo $grade->getId() ?>" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="name"></label>
                            <input type="text" name="name" id="name" placeholder="Grade Name" value="<?php echo $grade->getName() ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update Grade</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>