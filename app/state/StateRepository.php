<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class StateRepository extends Db
{
    public function findStateById(int $id)
    {
        $query = "SELECT * FROM `state` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findStates()
    {
        $query = "SELECT * FROM `state`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        return $resultSet;
    }

    public function findStatesByCounrty(int $counrtyId)
    {
        $isCounrty = true; // TODO

        if ($isCounrty == true) {
            $query = "SELECT * FROM `state` WHERE `counrtyId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$counrtyId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
        

    }
}