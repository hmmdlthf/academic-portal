<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/State.php';
require_once $ROOT . '/app/state/StateService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$stateService = new StateService();
$stateService->update($_GET['id'], $_POST['name']);
echo ("update Successfull");
header('Location: /admin/state/state.php?link=state');

?>