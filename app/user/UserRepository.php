<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class UserRepository extends Db
{
    public function findUserById(int $id)
    {
        $query = "SELECT * FROM `user` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findUsers()
    {
        $query = "SELECT * FROM `user`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        return $resultSet;
    }

    public function findUsersByCounrty(int $counrtyId)
    {
        $isCounrty = true; // TODO

        if ($isCounrty == true) {
            $query = "SELECT * FROM `user` WHERE `counrtyId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$counrtyId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
        

    }
}