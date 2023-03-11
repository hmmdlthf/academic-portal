<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/student/StudentRepository.php';
require_once $ROOT . '/app/city/CityService.php';
require_once $ROOT . '/app/grade/GradeService.php';
require_once $ROOT . '/app/officer/OfficerService.php';
require_once $ROOT . '/app/email/Email.php';
require_once $ROOT . '/app/utils/boolean.php';
require_once $ROOT . '/app/utils/date.php';
require_once $ROOT . '/app/appUser/Gender.php';

class StudentService
{
    private $studentRepository;

    public function __construct()
    {
        $this->studentRepository = new StudentRepository();
    }

    public function getStudentById(int $studentId)
    {
        return $this->studentRepository->findStudentById($studentId);
    }

    public function getStudentByEmail(string $email)
    {
        return $this->studentRepository->findStudentByEmail($email);
    }

    public function getStudentByUsername(string $username)
    {
        return $this->studentRepository->findStudentByUsername($username);
    }

    public function getStudents()
    {
        return $this->studentRepository->findStudents();
    }

    public function sendCreationEmail(Student $student, $password)
    {
        $body = "Your login credentials. <br><br>".
                "Credentials requested email: ". $student->getEmail() . "<br>".
                "Officer incharge: ". $student->getOfficer()->getFname() . $student->getOfficer()->getLname() . "<br>".
                "username: " . $student->getUsername() . "<br>".
                "password: " . $password . "<br>".
                "created at: " . $student->getCreatedDate() . "<br>".
                "click the link to verify <br>".
                "http://" . $_SERVER['HTTP_HOST'] . "/student/verify.php?email=". $student->getEmail() . "&token=" . $student->getToken() . "<br>"
        ;

        try {
            $email = new Email();
            $email->setTo($student->getEmail());
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

    public function save($email, $officer_username)
    {
        if ($this->getStudentByEmail($email) !== false) {
            echo ("student already exists");
            return false;
        }   
        $student = new Student();
        $student->setEmail($email);
        $student->setToken($student->generateToken());
        $student->setUsername($student->generateUsername($email));
        $password = $student->generatePassword();
        $student->setPassword($student->generateHash($password));
        $student->setUniqueId($student->generateUniqueId());
        $student->setNoAttempts(0);
        $student->setCreatedDate(date("Y-m-d H:i:s"));
        $student->setLastLogin(date("Y-m-d H:i:s"));
        $student->setIsVerified(false);
        $officerService = new OfficerService();
        $student->setOfficer($officerService->getOfficerByUsername($officer_username));
        $gradeService = new GradeService();
        $student->setGrade($gradeService->getGradeByName('gradeA'));
        $this->studentRepository->save($student);
        $this->sendCreationEmail($student, $password);
    }

    public function update($id, $fname, $lname, $address, $phone, $nic, $title, $dob, $gender, $maritalStatus, $cityId)
    {
        $student = $this->getStudentById($id);
        if ($student == false) {
            echo ("student not found");
            return false;
        }
        $student->setFname($fname);
        $student->setLname($lname);
        $student->setAddress($address);
        $student->setPhone($phone);
        $student->setNic($nic);
        $student->setTitle($title);
        $student->setDob(getMySqlDate($dob));
        $student->setGender(getGenderFromSelect($gender));
        $student->setMaritalStatus(getTinyIntFromCheck($maritalStatus));
        $city = new CityService();
        $student->setCity($city->getCityById($cityId));
        $this->studentRepository->update($student);
    }

    public function delete($id)
    {
        $student = $this->getStudentById($id);
        if ($student == false) {
            echo ("student not found");
            return false;
        }
        $this->studentRepository->delete($student);
    }

    public function sendVerifiedEmail(Student $student)
    {
        $body = "Your email ". $student->getEmail() ." verified successfully <br><br>";

        try {
            $email = new Email();
            $email->setTo($student->getEmail());
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
        $student = $this->getStudentByEmail($email);

        if ($student->getToken() == $token) {
            $student->setIsVerified(true);
            $this->studentRepository->verify($student);
            $this->sendVerifiedEmail($student);
        } else {
            die("invalid link");
        }
    }

    public function updateLogin(Student $student)
    {
        $this->studentRepository->updateLastLogin($student);
    }

    public function verifyPassword($username, $password)
    {
        $student = $this->getStudentByUsername($username);
        echo $student->getPassword() . "<br>";

        if (password_verify($password, $student->getPassword())) {
            $student->setLastLogin(date("Y-m-d H:i:s"));
            $this->updateLogin($student);
            return true;
        } else {
            echo ("password doesn't match <br>");
            return false;
        }
    }

    public function count()
    {
        return $this->studentRepository->count();
    }
}