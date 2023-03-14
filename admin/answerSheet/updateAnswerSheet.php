<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$answerSheetService = new AnswerSheetService();
$answerSheet = $answerSheetService->getAnswerSheetById($_GET['id']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | AnswerSheet</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="addAnswerSheetProcess.php?link=answerSheet&id=<?php echo $answerSheet->getFile(); ?>" method="post" enctype="multipart/form-data">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="file">File</label>
                            <input type="file" name="file" placeholder="AnswerSheet File" id="file" value="<?php echo $answerSheet->getFile(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update AnswerSheet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>