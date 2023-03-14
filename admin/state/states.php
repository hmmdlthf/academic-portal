<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/State.php';
require_once $ROOT . '/app/state/StateService.php';
require_once $ROOT . '/app/country/Country.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$stateService = new StateService();
$states = $stateService->getStates();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>States</title>
</head>

<body>
<button onclick="document.location = '/admin/state/addState.php'">Add State</button>
    <div class="states">

        <?php foreach ($states as $state) { ?>
            <div class="state">
                <div class="id"><?php echo $state->getId(); ?></div>
                <div class="name"><?php echo $state->getName(); ?></div>
                <div class="country"><?php echo $state->getCountry()->getName(); ?></div>
                <button onclick="document.location = '/admin/state/deleteState.php?id=<?php echo $state->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/state/updateState.php?id=<?php echo $state->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>