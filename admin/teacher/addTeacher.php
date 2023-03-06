<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/city/CityService.php';

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
    <title>Add Teacher</title>
</head>
<body>
    <form action="addTeacherProcess.php" method="post">
        <!-- <select name="cityId" id="" placeholder="Select City">
            <?php foreach($cities as $city) { ?>
                <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
            <?php } ?>
        </select> -->
        <!-- <input type="text" name="fname" placeholder="First Name" id="fname">
        <input type="text" name="lname" placeholder="Last Name" id="lname"> -->
        <input type="email" name="email" placeholder="Email" id="email">
        <!-- <input type="text" name="username" placeholder="Username" id="username">
        <input type="password" name="password" placeholder="Your Password" id="password">
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
        <input type="checkbox" name="marital_status" id="marital_status"> -->
        <button type="submit">Add Teacher</button>
    </form>
</body>
</html>