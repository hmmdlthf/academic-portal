<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/appUser/AppUser.php";

class Student extends AppUser
{
    private Grade $grade;
    private Officer $officer;

    public function getGrade()
    {
        return $this->grade;
    }

    public function getOfficer()
    {
        return $this->officer;
    }

    public function setGrade(Grade $grade)
    {
        $this->grade = $grade;
    }

    public function setOfficer(Officer $officer)
    {
        $this->officer = $officer;
    }
}