<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';

jwt_start(['officer_role']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Acedemy | Dashboard</title>

    <?php require $ROOT . '/officer/head/head.php'; ?>
</head>

<body>
    <div class="main">
    <?php require $ROOT . '/officer/menu.php'; ?>
        
        <div class="body">
        <?php require $ROOT . '/officer/header.php'; ?>
            <div class="body__content">
                <div class="small__cards">
                    <div class="card small__card"></div>
                    <div class="card small__card"></div>
                    <div class="card small__card"></div>
                    <div class="card small__card"></div>
                </div>
                <div class="big__cards">
                        <div class="card left__card"></div>
                        <div class="card right__card"></div>
                        <div class="card left__card"></div>
                </div>
            </div>
        </div>
    </div>
    
    <?php require $ROOT . '/officer/js/scripts.php'; ?>
</body>

</html>