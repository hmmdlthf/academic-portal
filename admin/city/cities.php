<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/city/CityService.php';
require_once $ROOT . '/app/state/State.php';

session_start();

$cityService = new CityService();
$cities = $cityService->getCities();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities</title>
</head>

<body>
<button onclick="document.location = '/admin/city/addCity.php'">Add City</button>
    <div class="cities">

        <?php foreach ($cities as $city) { ?>
            <div class="city">
                <div class="id"><?php echo $city->getId(); ?></div>
                <div class="name"><?php echo $city->getName(); ?></div>
                <div class="state"><?php echo $city->getState()->getName(); ?></div>
                <button onclick="document.location = '/admin/city/deleteCity.php?id=<?php echo $city->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/city/updateCity.php?id=<?php echo $city->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>