<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtService.php';

$jwt = $_COOKIE['jwt'];

if (!$jwt) {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$jwtService = new JwtService();
$jwtService->encodeArrayToJwt($jwt);

if ($jwtService->verifyJwt()) // check if the 'exp'(expire) is < than current time - opposite true
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

// The token is valid, so send the response back to the user
echo ("token valid <br>");
echo ("protected data <br>");
