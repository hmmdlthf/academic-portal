<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/jwt/JwtProtected.php';
$jwtService = jwt_start(['officer_role']);

require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/city/CityService.php';

$officerService = new OfficerService();
$officer = $officerService->getOfficerByUsername($jwtService->getUsername());

$cityService = new CityService();
$cities = $cityService->getCities();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Profile</title>

    <?php require $ROOT . '/officer/head/head.php'; ?>
</head>

<body>
    <div class="main">
        <?php require $ROOT . '/officer/menu.php'; ?>
        <div class="body">
            <?php require $ROOT . '/officer/header.php'; ?>
            <div class="body__content">
                <form action="updateProfileProcess.php?id=<?php echo $officer->getId() ?>" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" placeholder="First Name" id="fname" value="<?php echo $officer->getFname(); ?>">
                        </div>
                        <div class="form__control">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name" id="lname" value="<?php echo $officer->getLname(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="city">City</label>
                            <select name="cityId" id="city" placeholder="Select City">
                                <?php foreach ($cities as $city) { ?>
                                    <?php if ($officer->getCity() == $city) { ?>
                                        <option value="<?php echo $city->getId(); ?>" selected='selected'><?php echo $city->getName(); ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form__control">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" placeholder="Phone" id="phone" value="<?php echo $officer->getPhone(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" placeholder="Address" cols="30" rows="2" value=""><?php echo $officer->getAddress(); ?></textarea>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="nic">NIC</label>
                            <input type="text" name="nic" placeholder="NIC" id="nic" value="<?php echo $officer->getNic(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="title">Title</label>
                            <input type="text" name="title" placeholder="Title" id="title" value="<?php echo $officer->getTitle(); ?>">
                        </div>
                        <div class="form__control">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender">
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="dob">DOB</label>
                            <input type="date" name="dob" placeholder="DOB" id="dob" value="<?php echo $officer->getDob(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control row">
                            <?php if ($officer->getMaritalStatus() == 1) { ?>
                                <input type="checkbox" name="marital_status" id="marital_status" checked>
                            <?php } else { ?>
                                <input type="checkbox" name="marital_status" id="marital_status">
                            <?php } ?>
                            <label for="marital_status">Marital Status</label>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control row">
                            <button type="button" class="btn" onclick="document.location = '/officer/profile/profile.php?link=profile'">Cancel</button>
                            <button type="submit" class="btn btn__primary">Update</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/officer/js/scripts.php'; ?>
</body>

</html>