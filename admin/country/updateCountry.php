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
$country = $countryService->getCountryById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Country</title>
</head>
<body>
    <form action="updateCountryProcess.php?id=<?php echo $country->getId() ?>" method="post">
        <input type="text" name="name" placeholder="Country Name" id="name" value="<?php echo $country->getName() ?>">
        <button type="submit">update Country</button>
    </form>
</body>
</html>