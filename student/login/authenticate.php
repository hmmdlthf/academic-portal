<?php 

use Firebase\JWT\JWT;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/jwt/JwtService.php';

// Validate the credentials against a database, or other data store.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $rememberMe = test_input($_POST['remember_me']);

    echo $username . "<br>";
    echo $password . "<br>";
    echo $rememberMe . "<br>";

    $studentService = new StudentService();
    $studentService->verifyPassword($username, $password);
    $hasValidCredentials = true;
    echo ("correct password <br>");
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($hasValidCredentials) {
    $jwtSevice = new JwtService(['student_role']);
    if (isset($_POST['remember_me']) & $_POST['remember_me'] == 'on') {
        $jwtSevice->config('10080', $username);
    } else {
        $jwtSevice->config('1440', $username);
    }
    $jwtSevice->createJwt('/student');
    echo ("jwt created successfully");
    header('Location: '. '/student/dashboard/dashboard.php?link=dashboard');
}