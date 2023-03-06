<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/student/Student.php";
require_once $ROOT . "/app/city/CityService.php";
require_once $ROOT . "/app/officer/OfficerService.php";
require_once $ROOT . "/app/utils/boolean.php";

class StudentRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $student = new Student();
        $student->setId($array['id']);
        $student->setEmail($array['email']);
        $student->setUsername($array['username']);
        $student->setPassword($array['password']);
        $student->setToken($array['token']);
        $student->setUniqueId($array['unique_id']);
        $student->setNoAttempts($array['no_attempts']);
        $student->setCreatedDate($array['created_date']);
        $student->setLastLogin($array['last_login']);
        $student->setIsVerified($array['is_verified']);
        $officerService = new OfficerService();
        $student->setOfficer($officerService->getOfficerById($array['officer_id']));

        if (array_key_exists('fname', $array)) {
            $student->setFname($array['fname']);
        }
        if (array_key_exists('lname', $array)) {
            $student->setLname($array['lname']);
        }
        if (array_key_exists('address', $array)) {
            $student->setAddress($array['address']);
        }
        if (array_key_exists('phone', $array)) {
            $student->setPhone($array['phone']);
        }
        if (array_key_exists('nic', $array)) {
            $student->setNic($array['nic']);
        }
        if (array_key_exists('title', $array)) {
            $student->setTitle($array['title']);
        }
        if (array_key_exists('dob', $array)) {
            $student->setDob($array['dob']);
        }
        if (array_key_exists('gender', $array)) {
            $student->setGender($array['gender']);
        }
        if (array_key_exists('marital_status', $array)) {
            $student->setMaritalStatus($array['marital_status']);
        }
        if (array_key_exists('city_id', $array)) {
            if ($array['city_id'] == null) {
                $student->setCity(null);
            } else {
                $cityService = new CityService();
                $city = $cityService->getCityById($array['city_id']);
                if ($city == false) {
                    $student->setCity(null);
                } else {
                    $student->setCity($city);
                }
            }
        }
        return $student;
    }

    public function findStudentById(int $id)
    {
        $query = "SELECT * FROM `student` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findStudentByEmail(string $email)
    {
        $query = "SELECT * FROM `student` WHERE `email`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findStudentByUsername(string $username)
    {
        $query = "SELECT * FROM `student` WHERE `username`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$username]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findStudents()
    {
        $query = "SELECT * FROM `student`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $students = [];

        if ($resultSet > 0) {
            foreach ($resultSet as $studentArray) {
                $student = $this->addDetailsToModel($studentArray);
                $students[] = $student;
            }
            return $students;
        } else {
            false;
        }
        return $resultSet;
    }

    public function save(Student $student)
    {
        $query = "INSERT INTO `student` (`email`, `token`, `username`, `password`, `unique_id`, `no_attempts`, `created_date`, `last_login`, `is_verified`, `officer_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$student->getEmail(), 
                            $student->getToken(), 
                            $student->getUsername(), 
                            $student->getPassword(), 
                            $student->getUniqueId(), 
                            $student->getNoAttempts(), 
                            $student->getCreatedDate(), 
                            $student->getLastLogin(), 
                            getTinyInt($student->getIsVerified()), 
                            $student->getOfficer()->getId()]);
        return true;
    }

    public function update(Student $student)
    {
        $query = "UPDATE `student` SET `fname`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$student->getFname(), $student->getId()]);
        return true;
    }

    public function delete(Student $student)
    {
        $query = "DELETE FROM `student` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$student->getId()]);
    }

    public function verify(Student $student)
    {
        $query = "UPDATE `student` SET `is_verified`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$student->getIsVerified(), $student->getId()]);
        return true;
    }

    public function updateLastLogin(Student $student)
    {
        $query = "UPDATE `student` SET `last_login`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$student->getLastLogin(), $student->getId()]);
        return true;
    }
}
