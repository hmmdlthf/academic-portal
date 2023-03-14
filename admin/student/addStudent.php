<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$officerService = new OfficerService();
$officers = $officerService->getOfficers();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Add Student</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="addStudentProcess.php?link=add%20student" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="officer">Officer</label>
                            <select name="officer" id="officer" placeholder="select Officer">
                                <?php foreach ($officers as $officer) { ?>
                                    <option value="<?php echo $officer->getId(); ?>"><?php echo $officer->getEmail(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" id="email">
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