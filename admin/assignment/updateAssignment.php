<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/assignment/Assignment.php';
require_once $ROOT . '/app/assignment/AssignmentService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);
$assignmentService = new AssignmentService();
$assignment = $assignmentService->getAssignmentById($_GET['id']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | </title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="updateAssignmentProcess.php?id=<?php echo $assignment->getId() ?>&link=update%20assignment" method="post" enctype="multipart/form-data">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="file">File</label>
                            <input type="file" name="file" placeholder="File" id="file" value="<?php echo $assignment->getFile() ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit"></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>