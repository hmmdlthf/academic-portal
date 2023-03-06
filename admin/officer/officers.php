<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';
require_once $ROOT . '/app/city/City.php';

session_start();

$officerService = new OfficerService();
$officers = $officerService->getOfficers();
// $city = $officer->getCity();
// if (gettype($city) == City::class) {
//     $cityName = $city->getName();
// } else {
//     $cityName = null;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officers</title>
</head>

<body>
    <div class="officers">

        <?php foreach ($officers as $officer) { ?>
            <div class="officer">
                <div class="id"><?php echo "id: ". $officer->getId(); ?></div>
                <div class="fname"><?php echo "fname: ". $officer->getFname(); ?></div>
                <div class="lname"><?php echo "lname: ". $officer->getLname(); ?></div>
                <div class="email"><?php echo "email: ". $officer->getEmail(); ?></div>
                <div class="username"><?php echo "username: ". $officer->getUsername(); ?></div>
                <div class="password"><?php echo "password: ". $officer->getPassword(); ?></div>
                <div class="token"><?php echo "token: ". $officer->getToken(); ?></div>
                <div class="unique_id"><?php echo "unique_id: ". $officer->getUniqueId(); ?></div>
                <div class="no_attempts"><?php echo "no attempts: ". $officer->getNoAttempts(); ?></div>
                <div class="created_date"><?php echo "created at: ". $officer->getCreatedDate(); ?></div>
                <div class="last_login"><?php echo "last login: ". $officer->getLastLogin(); ?></div>
                <div class="is_verified"><?php echo "is verified: ". $officer->getIsVerified(); ?></div>
                <div class="address"><?php echo "address: ". $officer->getAddress(); ?></div>
                <div class="phone"><?php echo "phone: ". $officer->getPhone(); ?></div>
                <div class="nic"><?php echo "nic: ". $officer->getNic(); ?></div>
                <div class="title"><?php echo "title: ". $officer->getTitle(); ?></div>
                <div class="dob"><?php echo "dob: ". $officer->getDob(); ?></div>
                <div class="gender"><?php echo "gender: ". $officer->getGender(); ?></div>
                <div class="marital_status"><?php echo "marital status: ". $officer->getMaritalStatus(); ?></div>
                <div class="city"><?php echo "city: ". $cityName ?></div>
                <button onclick="document.location = '/admin/officer/deleteOfficer.php?id=<?php echo $officer->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/officer/updateOfficer.php?id=<?php echo $officer->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>