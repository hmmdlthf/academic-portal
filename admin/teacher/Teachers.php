<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';
require_once $ROOT . '/app/city/City.php';

session_start();

$teacherService = new TeacherService();
$teachers = $teacherService->getTeachers();
// $city = $teacher->getCity();
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
    <title>Teachers</title>
</head>

<body>
<button onclick="document.location = '/admin/teacher/addTeacher.php'">Add Teacher</button>
    <div class="teachers">

        <?php foreach ($teachers as $teacher) { ?>
            <div class="teacher">
                <div class="id"><?php echo "id: ". $teacher->getId(); ?></div>
                <div class="fname"><?php echo "fname: ". $teacher->getFname(); ?></div>
                <div class="lname"><?php echo "lname: ". $teacher->getLname(); ?></div>
                <div class="email"><?php echo "email: ". $teacher->getEmail(); ?></div>
                <div class="username"><?php echo "username: ". $teacher->getUsername(); ?></div>
                <div class="password"><?php echo "password: ". $teacher->getPassword(); ?></div>
                <div class="token"><?php echo "token: ". $teacher->getToken(); ?></div>
                <div class="unique_id"><?php echo "unique_id: ". $teacher->getUniqueId(); ?></div>
                <div class="no_attempts"><?php echo "no attempts: ". $teacher->getNoAttempts(); ?></div>
                <div class="created_date"><?php echo "created at: ". $teacher->getCreatedDate(); ?></div>
                <div class="last_login"><?php echo "last login: ". $teacher->getLastLogin(); ?></div>
                <div class="is_verified"><?php echo "is verified: ". $teacher->getIsVerified(); ?></div>
                <div class="address"><?php echo "address: ". $teacher->getAddress(); ?></div>
                <div class="phone"><?php echo "phone: ". $teacher->getPhone(); ?></div>
                <div class="nic"><?php echo "nic: ". $teacher->getNic(); ?></div>
                <div class="title"><?php echo "title: ". $teacher->getTitle(); ?></div>
                <div class="dob"><?php echo "dob: ". $teacher->getDob(); ?></div>
                <div class="gender"><?php echo "gender: ". $teacher->getGender(); ?></div>
                <div class="marital_status"><?php echo "marital status: ". $teacher->getMaritalStatus(); ?></div>
                <div class="city"><?php echo "city: ". $cityName ?></div>
                <button onclick="document.location = '/admin/teacher/deleteTeacher.php?id=<?php echo $teacher->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/teacher/updateTeacher.php?id=<?php echo $teacher->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>