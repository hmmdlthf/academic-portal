<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/teacher/TeacherRepository.php';
require_once $ROOT . '/app/city/CityService.php';
require_once $ROOT . '/app/email/Email.php';
require_once $ROOT . '/app/utils/boolean.php';
require_once $ROOT . '/app/utils/date.php';

class TeacherService
{
    private $teacherRepository;

    public function __construct()
    {
        $this->teacherRepository = new TeacherRepository();
    }

    public function getTeacherById(int $teacherId)
    {
        return $this->teacherRepository->findTeacherById($teacherId);
    }

    public function getTeacherByEmail(string $email)
    {
        return $this->teacherRepository->findTeacherByEmail($email);
    }

    public function getTeacherByUsername(string $username)
    {
        return $this->teacherRepository->findTeacherByUsername($username);
    }

    public function getTeachers()
    {
        return $this->teacherRepository->findTeachers();
    }

    public function sendCreationEmail(Teacher $teacher, $password)
    {
        $body = "Your login credentials. <br><br>".
                "Credentials requested email: ". $teacher->getEmail() . "<br>".
                "username: " . $teacher->getUsername() . "<br>".
                "password: " . $password . "<br>".
                "created at: " . $teacher->getCreatedDate() . "<br>".
                "click the link to verify <br>".
                "http://" . $_SERVER['HTTP_HOST'] . "/teacher/verify.php?email=". $teacher->getEmail() . "&token=" . $teacher->getToken() . "<br>"
        ;

        try {
            $email = new Email();
            $email->setTo($teacher->getEmail());
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
        if ($this->getTeacherByEmail($email) !== false) {
            echo ("teacher already exists");
            return false;
        }   
        $teacher = new Teacher();
        $teacher->setEmail($email);
        $teacher->setToken($teacher->generateToken());
        $teacher->setUsername($teacher->generateUsername($email));
        $password = $teacher->generatePassword();
        $teacher->setPassword($teacher->generateHash($password));
        $teacher->setUniqueId($teacher->generateUniqueId());
        $teacher->setNoAttempts(0);
        $teacher->setCreatedDate(date("Y-m-d H:i:s"));
        $teacher->setLastLogin(date("Y-m-d H:i:s"));
        $teacher->setIsVerified(false);
        $this->teacherRepository->save($teacher);
        $this->sendCreationEmail($teacher, $password);
    }

    public function update($id, $fname, $lname, $address, $phone, $nic, $title, $dob, $gender, $maritalStatus, $cityId)
    {
        $teacher = $this->getTeacherById($id);
        if ($teacher == false) {
            echo ("teacher not found");
            return false;
        }
        $teacher->setFname($fname);
        $teacher->setLname($lname);
        $teacher->setAddress($address);
        $teacher->setPhone($phone);
        $teacher->setNic($nic);
        $teacher->setTitle($title);
        $teacher->setDob(getMySqlDate($dob));
        $teacher->setGender(getGenderFromSelect($gender));
        $teacher->setMaritalStatus(getTinyIntFromCheck($maritalStatus));
        $city = new CityService();
        $teacher->setCity($city->getCityById($cityId));
        $this->teacherRepository->update($teacher);
    }

    public function delete($id)
    {
        $teacher = $this->getTeacherById($id);
        if ($teacher == false) {
            echo ("teacher not found");
            return false;
        }
        $this->teacherRepository->delete($teacher);
    }

    public function sendVerifiedEmail(Teacher $teacher)
    {
        $body = "Your email ". $teacher->getEmail() ." verified successfully <br><br>";

        try {
            $email = new Email();
            $email->setTo($teacher->getEmail());
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
        $teacher = $this->getTeacherByEmail($email);

        if ($teacher->getIsVerified() == 1) {
            die('link already used');
            return true;
        } 

        if ($teacher->getToken() == $token) {
            $teacher->setIsVerified(true);
            $this->teacherRepository->verify($teacher);
            $this->sendVerifiedEmail($teacher);
        } else {
            die("invalid link");
        }
    }

    public function updateLogin(Teacher $teacher)
    {
        $this->teacherRepository->updateLastLogin($teacher);
    }

    public function verifyPassword($username, $password)
    {
        $teacher = $this->getTeacherByUsername($username);
        echo $teacher->getPassword() . "<br>";

        if (password_verify($password, $teacher->getPassword())) {
            $teacher->setLastLogin(date("Y-m-d H:i:s"));
            $this->updateLogin($teacher);
            return true;
        } else {
            echo ("password doesn't match <br>");
            return false;
        }
    }

    public function count()
    {
        return $this->teacherRepository->count();
    }
}