<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/city/City.php';
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$studentService = new StudentService();
$students = $studentService->getStudents();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
</head>

<body>
<button onclick="document.location = '/admin/student/addStudent.php'">Add Student</button>
    <div class="students">

        <?php foreach ($students as $student) { ?>
            <div class="student">
                <div class="id"><?php echo "id: ". $student->getId(); ?></div>
                <div class="fname"><?php echo "fname: ". $student->getFname(); ?></div>
                <div class="lname"><?php echo "lname: ". $student->getLname(); ?></div>
                <div class="email"><?php echo "email: ". $student->getEmail(); ?></div>
                <div class="username"><?php echo "username: ". $student->getUsername(); ?></div>
                <div class="password"><?php echo "password: ". $student->getPassword(); ?></div>
                <div class="token"><?php echo "token: ". $student->getToken(); ?></div>
                <div class="unique_id"><?php echo "unique_id: ". $student->getUniqueId(); ?></div>
                <div class="no_attempts"><?php echo "no attempts: ". $student->getNoAttempts(); ?></div>
                <div class="created_date"><?php echo "created at: ". $student->getCreatedDate(); ?></div>
                <div class="last_login"><?php echo "last login: ". $student->getLastLogin(); ?></div>
                <div class="is_verified"><?php echo "is verified: ". $student->getIsVerified(); ?></div>
                <div class="address"><?php echo "address: ". $student->getAddress(); ?></div>
                <div class="phone"><?php echo "phone: ". $student->getPhone(); ?></div>
                <div class="nic"><?php echo "nic: ". $student->getNic(); ?></div>
                <div class="title"><?php echo "title: ". $student->getTitle(); ?></div>
                <div class="dob"><?php echo "dob: ". $student->getDob(); ?></div>
                <div class="gender"><?php echo "gender: ". $student->getGender(); ?></div>
                <div class="marital_status"><?php echo "marital status: ". $student->getMaritalStatus(); ?></div>
                <div class="city"><?php echo "city: ". $cityName ?></div>
                <div class="officer"><?php echo "officer: ". $student->getOfficer()->getEmail(); ?></div>
                <div class="grade"><?php echo "grade: ". $student->getGrade()->getName(); ?></div>
                <button onclick="document.location = '/admin/student/deleteStudent.php?id=<?php echo $student->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/student/updateStudent.php?id=<?php echo $student->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>