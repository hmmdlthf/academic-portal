<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/State.php';
require_once $ROOT . '/app/state/StateService.php';

session_start();

$stateService = new StateService();
$stateService->update($_GET['id'], $_POST['name']);
echo ("update Successfull");

?>