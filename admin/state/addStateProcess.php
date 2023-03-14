<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/StateService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$stateName = $_POST['name'];
if (empty($stateName)) {
    die('Please enter state name');
}

$countryId = $_POST['country'];
if (empty($stateName)) {
    die('Please select parent country');
}

$stateService = new StateService();
$stateService->save($stateName, $countryId);
echo ("successfull added");
header('Location: /admin/state/state.php?link=state');