<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';
require_once $ROOT . '/app/city/CityService.php';

session_start();
$officerService = new OfficerService();
$officer = $officerService->getOfficerById($_GET['id']);

$cities = (new CityService())->getCities();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Officer</title>
</head>

<body>
    <form action="updateOfficerProcess.php?id=<?php echo $officer->getId() ?>" method="post">
        <select name="cityId" id="" placeholder="Select City">
            <?php foreach ($cities as $city) { ?>
                <?php if (is_string($officer->getCity())) { ?>
                    <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                <?php } else if ($city->getId() == $officer->getCity()->getId()) { ?>
                    <option value="<?php echo $city->getId(); ?>" selected><?php echo $city->getName(); ?></option>
                <?php } else { ?>
                    <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                <?php } ?>

            <?php } ?>
        </select>
        <input type="text" name="fname" placeholder="First Name" id="fname">
        <input type="text" name="lname" placeholder="Last Name" id="lname">
        <input type="text" name="address" placeholder="Address" id="address">
        <input type="number" name="phone" placeholder="Phone" id="phone">
        <input type="text" name="nic" placeholder="NIC" id="nic">
        <input type="text" name="title" placeholder="Title" id="title">
        <input type="date" name="dob" placeholder="DOB" id="dob">
        <select name="gender" id="gender">
            <option value="m">Male</option>
            <option value="f">Female</option>
        </select>
        <label for="marital_status"></label>
        <input type="checkbox" name="marital_status" id="marital_status">
        <button type="submit">update Officer</button>
    </form>
</body>

</html>