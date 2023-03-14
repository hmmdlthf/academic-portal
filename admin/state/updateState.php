<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/State.php';
require_once $ROOT . '/app/state/StateService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);
$stateService = new StateService();
$state = $stateService->getStateById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Update State</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="updateStateProcess.php?id=<?php echo $state->getId() ?>" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="state">State</label>
                            <input type="text" name="name" placeholder="State Name" id="name" value="<?php echo $state->getName() ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update State</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>