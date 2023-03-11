<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/officer/Officer.php";
require_once $ROOT . "/app/city/CityService.php";
require_once $ROOT . "/app/utils/boolean.php";

class OfficerRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $officer = new Officer();
        $officer->setId($array['id']);
        $officer->setEmail($array['email']);
        $officer->setUsername($array['username']);
        $officer->setPassword($array['password']);
        $officer->setToken($array['token']);
        $officer->setUniqueId($array['unique_id']);
        $officer->setNoAttempts($array['no_attempts']);
        $officer->setCreatedDate($array['created_date']);
        $officer->setLastLogin($array['last_login']);
        $officer->setIsVerified($array['is_verified']);

        if (array_key_exists('fname', $array)) {
            $officer->setFname($array['fname']);
        }
        if (array_key_exists('lname', $array)) {
            $officer->setLname($array['lname']);
        }
        if (array_key_exists('address', $array)) {
            $officer->setAddress($array['address']);
        }
        if (array_key_exists('phone', $array)) {
            $officer->setPhone($array['phone']);
        }
        if (array_key_exists('nic', $array)) {
            $officer->setNic($array['nic']);
        }
        if (array_key_exists('title', $array)) {
            $officer->setTitle($array['title']);
        }
        if (array_key_exists('dob', $array)) {
            $officer->setDob($array['dob']);
        }
        if (array_key_exists('gender', $array)) {
            $officer->setGender($array['gender']);
        }
        if (array_key_exists('marital_status', $array)) {
            $officer->setMaritalStatus($array['marital_status']);
        }
        if (array_key_exists('city_id', $array)) {
            if ($array['city_id'] == null) {
                $officer->setCity(null);
            } else {
                $cityService = new CityService();
                $city = $cityService->getCityById($array['city_id']);
                if ($city == false) {
                    $officer->setCity(null);
                } else {
                    $officer->setCity($city);
                }
            }
        }
        return $officer;
    }

    public function findOfficerById(int $id)
    {
        $query = "SELECT * FROM `officer` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findOfficerByEmail(string $email)
    {
        $query = "SELECT * FROM `officer` WHERE `email`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findOfficerByUsername(string $username)
    {
        $query = "SELECT * FROM `officer` WHERE `username`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$username]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findOfficers()
    {
        $query = "SELECT * FROM `officer`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $officers = [];

        if ($resultSet > 0) {
            foreach ($resultSet as $officerArray) {
                $officer = $this->addDetailsToModel($officerArray);
                $officers[] = $officer;
            }
            return $officers;
        } else {
            false;
        }
        return $resultSet;
    }

    public function save(Officer $officer)
    {
        $query = "INSERT INTO `officer` (`email`, `token`, `username`, `password`, `unique_id`, `no_attempts`, `created_date`, `last_login`, `is_verified`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$officer->getEmail(), $officer->getToken(), $officer->getUsername(), $officer->getPassword(), $officer->getUniqueId(), $officer->getNoAttempts(), $officer->getCreatedDate(), $officer->getLastLogin(), getTinyInt($officer->getIsVerified())]);
        return true;
    }

    public function update(Officer $officer)
    {
        $query = "UPDATE `officer` SET `fname`=?, `lname`=?, `address`=?, `phone`=?, `nic`=?, `title`=?, `dob`=?, `gender`=?, `marital_status`=?, `city_id`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$officer->getFname(), $officer->getLname(), $officer->getAddress(), $officer->getPhone(), $officer->getNic(), $officer->getTitle(), $officer->getDob(), $officer->getGender(), $officer->getMaritalStatus(), $officer->getCity()->getId(), $officer->getId()]);
        return true;
    }

    public function delete(Officer $officer)
    {
        $query = "DELETE FROM `officer` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$officer->getId()]);
    }

    public function verify(Officer $officer)
    {
        $query = "UPDATE `officer` SET `is_verified`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$officer->getIsVerified(), $officer->getId()]);
        return true;
    }

    public function updateLastLogin(Officer $officer)
    {
        $query = "UPDATE `officer` SET `last_login`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$officer->getLastLogin(), $officer->getId()]);
        return true;
    }
}
