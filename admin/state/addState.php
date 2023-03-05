<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/country/Country.php';
require_once $ROOT . '/app/country/CountryService.php';

session_start();

$countryService = new CountryService();
$countries = $countryService->getCountries();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add State</title>
</head>
<body>
    <form action="addStateProcess.php" method="post">
        <select name="countryId" id="" placeholder="Select Country">
            <?php foreach($countries as $country) { ?>
                <option value="<?php echo $country->getId(); ?>"><?php echo $country->getName(); ?></option>
            <?php } ?>
        </select>
        <input type="text" name="name" placeholder="State Name" id="name">
        <button type="submit">Add State</button>
    </form>
</body>
</html>