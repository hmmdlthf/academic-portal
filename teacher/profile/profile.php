<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/jwt/JwtProtected.php';
$jwtService = jwt_start(['teacher_role']);

require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/city/CityService.php';

$teacherService = new TeacherService();
$teacher = $teacherService->getTeacherByUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Profile</title>

    <?php require $ROOT . '/teacher/head/head.php'; ?>
</head>

<body>
    <div class="main">
        <?php require $ROOT . '/teacher/menu.php'; ?>
        <div class="body">
            <?php require $ROOT . '/teacher/header.php'; ?>
            <div class="body__content">
                <form action="updateProfileProcess.php?id=<?php echo $teacher->getId() ?>" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" placeholder="First Name" id="fname" value="<?php echo $teacher->getFname(); ?>" disabled>
                        </div>
                        <div class="form__control">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name" id="lname" value="<?php echo $teacher->getLname(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        
                        <div class="form__control">
                            <label for="city">City</label>
                            <?php if (is_string($teacher->getCity())) { ?>
                                <input type="text" name="city" placeholder="City" id="city" value="<?php echo $teacher->getCity(); ?>" disabled>
                            <?php } else { ?>
                                <input type="text" name="city" placeholder="City" id="city" value="<?php echo $teacher->getCity()->getName(); ?>" disabled>
                            <?php } ?>
                            
                        </div>
                        <div class="form__control">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" placeholder="Phone" id="phone" value="<?php echo $teacher->getPhone(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" placeholder="Address" cols="30" rows="2" value="" disabled><?php echo $teacher->getAddress(); ?></textarea>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="nic">NIC</label>
                            <input type="text" name="nic" placeholder="NIC" id="nic" value="<?php echo $teacher->getNic(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="title">Title</label>
                            <input type="text" name="title" placeholder="Title" id="title" value="<?php echo $teacher->getTitle(); ?>" disabled>
                        </div>
                        <div class="form__control">
                            <label for="gender">Gender</label>
                            <input type="text" name="gender" placeholder="Gender" id="gender" value="<?php echo $teacher->getGender(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="dob">DOB</label>
                            <input type="date" name="dob" placeholder="DOB" id="dob" value="<?php echo $teacher->getDob(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control row">
                            <?php if ($teacher->getMaritalStatus() == 1) { ?>
                                <input type="checkbox" name="marital_status" id="marital_status" checked disabled>
                            <?php } else { ?>
                                <input type="checkbox" name="marital_status" id="marital_status" disabled>
                            <?php } ?>
                            <label for="marital_status">Marital Status</label>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button type="button" class="btn btn__primary" onclick="document.location = '/teacher/profile/updateProfile.php?link=update%20profile'">Edit</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/teacher/js/scripts.php'; ?>
</body>

</html>