<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';

$jwtService = jwt_start(['admin_role']);

$answerSheets = (new AnswerSheetService())->getAnswerSheets();

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
                <?php if (count($answerSheets) > 0) { ?>
                    <div class="filters">
                        <div class="form__group">
                            <div class="form__control">
                                <select name="assignment" id="assignment">
                                    <option value="">assignment1</option>
                                    <option value="">assignment2</option>
                                    <option value="">assignment3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="form__control">
                                <input type="text" name="name" placeholder="Name" id="">
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>File</th>
                                    <th>Marks</th>
                                    <th>Status</th>
                                    <th>Assignment</th>
                                    <th>Assignment File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($answerSheets as $answerSheet) { ?>
                                    <tr>
                                        <td><?php echo $answerSheet->getId(); ?></td>
                                        <td><a href="<?php echo $answerSheet->getFile(); ?>" download="">Download</a></td>
                                        <td><?php echo $answerSheet->getMarks(); ?></td>
                                        <td><?php echo $answerSheet->getStatus(); ?></td>
                                        <td><?php echo $answerSheet->getAssignment()->getId(); ?></td>
                                        <td><a href="<?php echo $answerSheet->getAssignment()->getFile(); ?>" download="">Download</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no answer sheets submitted
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>

</html>