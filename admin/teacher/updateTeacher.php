<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';
require_once $ROOT . '/app/city/CityService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/appUser/Gender.php';

$jwtService = jwt_start(['admin_role']);
$teacherService = new TeacherService();
$teacher = $teacherService->getTeacherById($_GET['id']);

$cities = (new CityService())->getCities();
$genders = ['m', 'f'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | update teacher</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="updateTeacherProcess.php?id=<?php echo $teacher->getId() ?>" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="city">city</label>
                            <select name="city" id="city" placeholder="Select City">
                                <?php foreach ($cities as $city) { ?>
                                    <?php if (is_string($teacher->getCity())) { ?>
                                        <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
                                    <?php } else if ($city->getId() == $teacher->getCity()->getId()) { ?>
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
                            <input type="text" name="fname" placeholder="First Name" id="fname" value="<?php echo $teacher->getFname(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="lname">last name</label>
                            <input type="text" name="lname" placeholder="Last Name" id="lname" value="<?php echo $teacher->getLname(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="address">adddress</label>
                            <input type="text" name="address" placeholder="Address" id="address" value="<?php echo $teacher->getAddress(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="number">number</label>
                            <input type="number" name="phone" placeholder="Phone" id="phone" value="<?php echo $teacher->getPhone(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="nic">nic</label>
                            <input type="text" name="nic" placeholder="NIC" id="nic" value="<?php echo $teacher->getNic(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="title">title</label>
                            <input type="text" name="title" placeholder="Title" id="title" value="<?php echo $teacher->getTitle(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="dob">dob</label>
                            <input type="date" name="dob" placeholder="DOB" id="dob" value="<?php echo $teacher->getDob(); ?>">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="gender">gender</label>
                            <select name="gender" id="gender">
                                <?php foreach ($genders as $gender) { ?>
                                    <?php if (is_null($teacher->getGender())) { ?>
                                        <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                    <?php } else if ($gender == $teacher->getGender()) { ?>
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
                            <?php if ($teacher->getMaritalStatus() == 1) { ?>
                                <input type="checkbox" name="marital_status" id="marital_status" checked>
                            <?php } else { ?>
                                <input type="checkbox" name="marital_status" id="marital_status">
                            <?php } ?>
                            <label for="marital_status">Married</label>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Update Teacher</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>