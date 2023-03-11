<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/jwt/JwtProtected.php';
$jwtService = jwt_start(['student_role']);

require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/city/CityService.php';

$studentService = new StudentService();
$student = $studentService->getStudentByUsername($jwtService->getUsername());

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Profile</title>

    <?php require $ROOT . '/student/head/head.php'; ?>
</head>

<body>
    <div class="main">
        <?php require $ROOT . '/student/menu.php'; ?>
        <div class="body">
            <?php require $ROOT . '/student/header.php'; ?>
            <div class="body__content">
                <form action="updateProfileProcess.php?id=<?php echo $student->getId() ?>" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" placeholder="First Name" id="fname" value="<?php echo $student->getFname(); ?>" disabled>
                        </div>
                        <div class="form__control">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name" id="lname" value="<?php echo $student->getLname(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="city">City</label>
                            <?php if (is_string($student->getCity())) { ?>
                                <input type="text" name="city" placeholder="City" id="city" value="<?php echo $student->getCity(); ?>" disabled>
                            <?php } else { ?>
                                <input type="text" name="city" placeholder="City" id="city" value="<?php echo $student->getCity()->getName(); ?>" disabled>
                            <?php } ?>
                        </div>
                        <div class="form__control">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" placeholder="Phone" id="phone" value="<?php echo $student->getPhone(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" placeholder="Address" cols="30" rows="2" value="" disabled><?php echo $student->getAddress(); ?></textarea>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="nic">NIC</label>
                            <input type="text" name="nic" placeholder="NIC" id="nic" value="<?php echo $student->getNic(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="title">Title</label>
                            <input type="text" name="title" placeholder="Title" id="title" value="<?php echo $student->getTitle(); ?>" disabled>
                        </div>
                        <div class="form__control">
                            <label for="gender">Gender</label>
                            <input type="text" name="gender" placeholder="Gender" id="gender" value="<?php echo $student->getGender(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="dob">DOB</label>
                            <input type="date" name="dob" placeholder="DOB" id="dob" value="<?php echo $student->getDob(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control row">
                            <?php if ($student->getMaritalStatus() == 1) { ?>
                                <input type="checkbox" name="marital_status" id="marital_status" checked disabled>
                            <?php } else { ?>
                                <input type="checkbox" name="marital_status" id="marital_status" disabled>
                            <?php } ?>
                            <label for="marital_status">Marital Status</label>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button type="button" class="btn btn__primary" onclick="document.location = '/student/profile/updateProfile.php?link=update%20profile'">Edit</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/student/js/scripts.php'; ?>
</body>

</html>