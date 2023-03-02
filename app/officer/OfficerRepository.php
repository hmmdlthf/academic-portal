<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class OfficerRepository extends Db
{
    public function findOfficerById(int $id)
    {
        $query = "SELECT * FROM `officer` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
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
        return $resultSet;
    }

    public function findOfficersByCity(int $cityId)
    {
        $isCity = true; // TODO

        if ($isCity == true) {
            $query = "SELECT * FROM `officer` WHERE `cityId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$cityId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
        

    }
}