<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class LessonRepository extends Db
{
    public function findLessonById(int $id)
    {
        $query = "SELECT * FROM `lesson` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findLessons()
    {
        $query = "SELECT * FROM `lesson`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        return $resultSet;
    }

    public function findLessonsBySubject(int $subjectId)
    {
        $isSubject = true; // TODO

        if ($isSubject == true) {
            $query = "SELECT * FROM `lesson` WHERE `subjectId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$subjectId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
        

    }
}