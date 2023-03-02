<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class TeacherRepository extends Db
{
    public function findTeacherById(int $id)
    {
        $query = "SELECT * FROM `teacher` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
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
        return $resultSet;
    }

    public function findTeachersByCounrty(int $counrtyId)
    {
        $isCounrty = true; // TODO

        if ($isCounrty == true) {
            $query = "SELECT * FROM `teacher` WHERE `counrtyId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$counrtyId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
        

    }
}