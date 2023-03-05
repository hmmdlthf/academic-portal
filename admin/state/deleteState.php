<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/State.php';
require_once $ROOT . '/app/state/StateService.php';

session_start();

$stateService = new StateService();
$stateService->delete($_GET['id']);
echo ("delete Successfull");

?>