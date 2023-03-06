<?php 

session_start();

$username = $_POST['username'];
if (empty($username)) {
    die("enter username");
}

$password = $_POST['password'];
if (empty($password)) {
    die("enter password");
}

?>