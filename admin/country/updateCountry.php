<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/country/Country.php';
require_once $ROOT . '/app/country/CountryService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);
$countryService = new CountryService();
$country = $countryService->getCountryById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Update Country</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="updateCountryProcess.php?id=<?php echo $country->getId() ?>" method="post" enctype="multipart/form-data">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Country Name" id="name" value="<?php echo $country->getName() ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update Country</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>