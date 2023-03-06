<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtService.php';

$jwt = $_COOKIE['jwt'];

if (!$jwt) {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$jwtService = new JwtService(['officer_role']);
$jwtService->decodeJwtToArray($jwt);

if (!$jwtService->verifyJwt()) // check if the 'exp'(expire) is < than current time - opposite true
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>
<body>
    <form action="addStudentProcess.php" method="post">
        <input type="email" name="email" placeholder="Email" id="email">
        <button type="submit">Add Student</button>
    </form>
</body>
</html>