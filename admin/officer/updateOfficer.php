<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';
require_once $ROOT . '/app/city/CityService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/appUser/Gender.php';

$jwtService = jwt_start(['admin_role']);
$officerService = new OfficerService();
$officer = $officerService->getOfficerById($_GET['id']);

$cities = (new CityService())->getCities();
$genders = ['m', 'f'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | update officer</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="updateOfficerProcess.php?id=<?php echo $officer->getId() ?>" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="city">city</label>
                            <select name="city" id="city" placeholder="Select City">
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
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="name">first name</label>
                            <input type="text" name="fname" placeholder="First Name" id="fname" value="<?php echo $officer->getFname(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="lname">last name</label>
                            <input type="text" name="lname" placeholder="Last Name" id="lname" value="<?php echo $officer->getLname(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="address">adddress</label>
                            <input type="text" name="address" placeholder="Address" id="address" value="<?php echo $officer->getAddress(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="number">number</label>
                            <input type="number" name="phone" placeholder="Phone" id="phone" value="<?php echo $officer->getPhone(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="nic">nic</label>
                            <input type="text" name="nic" placeholder="NIC" id="nic" value="<?php echo $officer->getNic(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="title">title</label>
                            <input type="text" name="title" placeholder="Title" id="title" value="<?php echo $officer->getTitle(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="dob">dob</label>
                            <input type="date" name="dob" placeholder="DOB" id="dob" value="<?php echo $officer->getDob(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="gender">gender</label>
                            <select name="gender" id="gender">
                                <?php foreach ($genders as $gender) { ?>
                                    <?php if (is_null($officer->getGender())) { ?>
                                        <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                    <?php } else if ($gender == $officer->getGender()) { ?>
                                        <option value="<?php echo $gender; ?>" selected><?php echo $gender; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <?php if ($officer->getMaritalStatus() == 1) { ?>
                                <input type="checkbox" name="marital_status" id="marital_status" checked>
                            <?php } else { ?>
                                <input type="checkbox" name="marital_status" id="marital_status">
                            <?php } ?>
                            <label for="marital_status">Married</label>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update Officer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>