<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/StateService.php';

session_start();

$stateName = $_POST['name'];
if (empty($stateName)) {
    die('Please enter state name');
}

$countryId = $_POST['countryId'];
if (empty($stateName)) {
    die('Please select parent country');
}

$stateService = new StateService();
$stateService->save($stateName, $countryId);
echo ("successfull added");