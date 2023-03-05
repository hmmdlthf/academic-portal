<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/user/User.php";
require_once $ROOT . "/app/appUser/Gender.php";
require_once $ROOT . "/app/city/City.php";

class AppUser extends User
{
    protected $address;
    protected $phone;
    protected $nic;
    protected $title;
    protected $dob;
    protected $gender;
    protected $maritalStatus;
    protected City $city;

    public function getAddress()
    {
        return $this->address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getNic()
    {
        return $this->nic;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function setPhone(int $phone)
    {
        $this->phone = $phone;
    }

    public function setNic(string $nic)
    {
        $this->nic = $nic;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setDob(string $dob)
    {
        $this->dob = $dob;
    }

    public function setGender(Gender $gender)
    {
        $this->gender = $gender;
    }

    public function setMaritalStatus(bool $maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    public function setCity(City $city)
    {
        $this->city = $city;
    }
}