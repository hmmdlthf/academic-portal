<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/jwt/JwtService.php';

$jwt = $_COOKIE['jwt'];

if (!$jwt) {
    header('HTTP/1.0 400 Bad Request');
    exit;
}

$jwtService = new JwtService(['officer_role']);
$jwtService->decodeJwtToArray($jwt);

if (!$jwtService->verifyJwt()) // check if the 'exp'(expire) is < than current time - opposite true
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}

session_start();
$studentService = new StudentService();
$student = $studentService->getStudentById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Student</title>
</head>
<body>
    <form action="updateStudentProcess.php?id=<?php echo $student->getId() ?>" method="post">
        <select name="cityId" id="" placeholder="Select City">
        <?php foreach($cities as $city) { ?>
                <option value="<?php echo $city->getId(); ?>"><?php echo $city->getName(); ?></option>
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
        <button type="submit">update Student</button>
    </form>
</body>
</html>