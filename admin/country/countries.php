<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/country/Country.php';
require_once $ROOT . '/app/country/CountryService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$countryService = new CountryService();
$countries = $countryService->getCountries();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries</title>
</head>

<body>
<button onclick="document.location = '/admin/country/addCountry.php'">Add Country</button>
    <div class="countrys">

        <?php foreach ($countries as $country) { ?>
            <div class="country">
                <div class="id"><?php echo $country->getId(); ?></div>
                <div class="name"><?php echo $country->getName(); ?></div>
                <button onclick="document.location = '/admin/country/deleteCountry.php?id=<?php echo $country->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/country/updateCountry.php?id=<?php echo $country->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>