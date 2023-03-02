<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class StudentRepository extends Db
{
    public function findStudentById(int $id)
    {
        $query = "SELECT * FROM `student` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
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
        return $resultSet;
    }

    public function findStudentsByCounrty(int $counrtyId)
    {
        $isCounrty = true; // TODO

        if ($isCounrty == true) {
            $query = "SELECT * FROM `student` WHERE `counrtyId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$counrtyId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
        

    }
}