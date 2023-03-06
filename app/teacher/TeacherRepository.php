<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/teacher/Teacher.php";
require_once $ROOT . "/app/city/CityService.php";
require_once $ROOT . "/app/utils/boolean.php";

class TeacherRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $teacher = new Teacher();
        $teacher->setId($array['id']);
        $teacher->setEmail($array['email']);
        $teacher->setUsername($array['username']);
        $teacher->setPassword($array['password']);
        $teacher->setToken($array['token']);
        $teacher->setUniqueId($array['unique_id']);
        $teacher->setNoAttempts($array['no_attempts']);
        $teacher->setCreatedDate($array['created_date']);
        $teacher->setLastLogin($array['last_login']);
        $teacher->setIsVerified($array['is_verified']);

        if (array_key_exists('fname', $array)) {
            $teacher->setFname($array['fname']);
        }
        if (array_key_exists('lname', $array)) {
            $teacher->setLname($array['lname']);
        }
        if (array_key_exists('address', $array)) {
            $teacher->setAddress($array['address']);
        }
        if (array_key_exists('phone', $array)) {
            $teacher->setPhone($array['phone']);
        }
        if (array_key_exists('nic', $array)) {
            $teacher->setNic($array['nic']);
        }
        if (array_key_exists('title', $array)) {
            $teacher->setTitle($array['title']);
        }
        if (array_key_exists('dob', $array)) {
            $teacher->setDob($array['dob']);
        }
        if (array_key_exists('gender', $array)) {
            $teacher->setGender($array['gender']);
        }
        if (array_key_exists('marital_status', $array)) {
            $teacher->setMaritalStatus($array['marital_status']);
        }
        if (array_key_exists('city_id', $array)) {
            if ($array['city_id'] == null) {
                $teacher->setCity(null);
            } else {
                $cityService = new CityService();
                $city = $cityService->getCityById($array['city_id']);
                if ($city == false) {
                    $teacher->setCity(null);
                } else {
                    $teacher->setCity($city);
                }
            }
        }
        return $teacher;
    }

    public function findTeacherById(int $id)
    {
        $query = "SELECT * FROM `teacher` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findTeacherByEmail(string $email)
    {
        $query = "SELECT * FROM `teacher` WHERE `email`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findTeacherByUsername(string $username)
    {
        $query = "SELECT * FROM `teacher` WHERE `username`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$username]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findTeachers()
    {
        $query = "SELECT * FROM `teacher`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $teachers = [];

        if ($resultSet > 0) {
            foreach ($resultSet as $teacherArray) {
                $teacher = $this->addDetailsToModel($teacherArray);
                $teachers[] = $teacher;
            }
            return $teachers;
        } else {
            false;
        }
        return $resultSet;
    }

    public function save(Teacher $teacher)
    {
        $query = "INSERT INTO `teacher` (`email`, `token`, `username`, `password`, `unique_id`, `no_attempts`, `created_date`, `last_login`, `is_verified`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$teacher->getEmail(), $teacher->getToken(), $teacher->getUsername(), $teacher->getPassword(), $teacher->getUniqueId(), $teacher->getNoAttempts(), $teacher->getCreatedDate(), $teacher->getLastLogin(), getTinyInt($teacher->getIsVerified())]);
        return true;
    }

    public function update(Teacher $teacher)
    {
        $query = "UPDATE `teacher` SET `fname`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$teacher->getFname(), $teacher->getId()]);
        return true;
    }

    public function delete(Teacher $teacher)
    {
        $query = "DELETE FROM `teacher` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$teacher->getId()]);
    }

    public function verify(Teacher $teacher)
    {
        $query = "UPDATE `teacher` SET `is_verified`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$teacher->getIsVerified(), $teacher->getId()]);
        return true;
    }

    public function updateLastLogin(Teacher $teacher)
    {
        $query = "UPDATE `teacher` SET `last_login`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$teacher->getLastLogin(), $teacher->getId()]);
        return true;
    }
}
