<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/city/CityService.php';

session_start();
$cityService = new CityService();
$city = $cityService->getCityById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update City</title>
</head>
<body>
    <form action="updateCityProcess.php?id=<?php echo $city->getId() ?>" method="post">
        <input type="text" name="name" placeholder="City Name" id="name" value="<?php echo $city->getName() ?>">
        <button type="submit">update City</button>
    </form>
</body>
</html>