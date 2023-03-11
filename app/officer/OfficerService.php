<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/officer/OfficerRepository.php';
require_once $ROOT . '/app/city/CityService.php';
require_once $ROOT . '/app/email/Email.php';
require_once $ROOT . '/app/utils/boolean.php';
require_once $ROOT . '/app/utils/date.php';
require_once $ROOT . '/app/appUser/Gender.php';

class OfficerService
{
    private $officerRepository;

    public function __construct()
    {
        $this->officerRepository = new OfficerRepository();
    }

    public function getOfficerById(int $officerId)
    {
        return $this->officerRepository->findOfficerById($officerId);
    }

    public function getOfficerByEmail(string $email)
    {
        return $this->officerRepository->findOfficerByEmail($email);
    }

    public function getOfficerByUsername(string $username)
    {
        return $this->officerRepository->findOfficerByUsername($username);
    }

    public function getOfficers()
    {
        return $this->officerRepository->findOfficers();
    }

    public function sendCreationEmail(Officer $officer, $password)
    {
        $body = "Your login credentials. <br><br>".
                "Credentials requested email: ". $officer->getEmail() . "<br>".
                "username: " . $officer->getUsername() . "<br>".
                "password: " . $password . "<br>".
                "created at: " . $officer->getCreatedDate() . "<br>".
                "click the link to verify <br>".
                "http://" . $_SERVER['HTTP_HOST'] . "/officer/verify.php?email=". $officer->getEmail() . "&token=" . $officer->getToken() . "<br>"
        ;

        try {
            $email = new Email();
            $email->setTo($officer->getEmail());
            $email->setSubject('Welcome to Online Academy');
            $email->setIsHTML(true);
            $email->setBody($body);
            $email->setAltBody("we sent the email in html, it seems your mail server doesn't support html");
            $email->setSendersName("Online Academy");
            $email->sendEmail();
        } catch (Exception $e) {
            die("error $e");
        }

        
    }

    public function save($email)
    {
        if ($this->getOfficerByEmail($email) !== false) {
            echo ("officer already exists");
            return false;
        }   
        $officer = new Officer();
        $officer->setEmail($email);
        $officer->setToken($officer->generateToken());
        $officer->setUsername($officer->generateUsername($email));
        $password = $officer->generatePassword();
        $officer->setPassword($officer->generateHash($password));
        $officer->setUniqueId($officer->generateUniqueId());
        $officer->setNoAttempts(0);
        $officer->setCreatedDate(date("Y-m-d H:i:s"));
        $officer->setLastLogin(date("Y-m-d H:i:s"));
        $officer->setIsVerified(false);
        $this->officerRepository->save($officer);
        $this->sendCreationEmail($officer, $password);
    }

    public function update($id, $fname, $lname, $address, $phone, $nic, $title, $dob, $gender, $maritalStatus, $cityId)
    {
        $officer = $this->getOfficerById($id);
        if ($officer == false) {
            echo ("officer not found");
            return false;
        }
        $officer->setFname($fname);
        $officer->setLname($lname);
        $officer->setAddress($address);
        $officer->setPhone($phone);
        $officer->setNic($nic);
        $officer->setTitle($title);
        $officer->setDob(getMySqlDate($dob));
        $officer->setGender(getGenderFromSelect($gender));
        $officer->setMaritalStatus(getTinyIntFromCheck($maritalStatus));
        $city = new CityService();
        $officer->setCity($city->getCityById($cityId));
        $this->officerRepository->update($officer);
    }

    public function delete($id)
    {
        $officer = $this->getOfficerById($id);
        if ($officer == false) {
            echo ("officer not found");
            return false;
        }
        $this->officerRepository->delete($officer);
    }

    public function sendVerifiedEmail(Officer $officer)
    {
        $body = "Your email ". $officer->getEmail() ." verified successfully <br><br>";

        try {
            $email = new Email();
            $email->setTo($officer->getEmail());
            $email->setSubject('Verify Success');
            $email->setIsHTML(true);
            $email->setBody($body);
            $email->setAltBody("we sent the email in html, it seems your mail server doesn't support html");
            $email->setSendersName("Online Academy");
            $email->sendEmail();
        } catch (Exception $e) {
            die("error $e");
        }
    }

    public function verify($email, $token)
    {
        $officer = $this->getOfficerByEmail($email);

        if ($officer->getToken() == $token) {
            $officer->setIsVerified(true);
            $this->officerRepository->verify($officer);
            $this->sendVerifiedEmail($officer);
        } else {
            die("invalid link");
        }
    }

    public function updateLogin(Officer $officer)
    {
        $this->officerRepository->updateLastLogin($officer);
    }

    public function verifyPassword($username, $password)
    {
        $officer = $this->getOfficerByUsername($username);
        echo $officer->getPassword() . "<br>";

        if (password_verify($password, $officer->getPassword())) {
            $officer->setLastLogin(date("Y-m-d H:i:s"));
            $this->updateLogin($officer);
            return true;
        } else {
            echo ("password doesn't match <br>");
            return false;
        }
    }

    public function count()
    {
        return $this->officerRepository->count();
    }
}