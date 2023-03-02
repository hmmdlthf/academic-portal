<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Teacher extends Db
{
    private $fname;
    private $lname;
    private $email;
    private $username;
    private $password;
    private $token;
    private $unique_id;
    private $no_attempts;
    private $created_date;
    private $last_login;
    private $is_verified;
    private $address;
    private $phone;
    private $nic;
    private $title;
    private $dob;
    private $gender;
    private $marital_status;
    private City $city;
    
}