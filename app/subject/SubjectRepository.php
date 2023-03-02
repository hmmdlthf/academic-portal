<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class SubjectRepository extends Db
{
    public function findSubjectById(int $id)
    {
        $query = "SELECT * FROM `subject` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findSubjects()
    {
        $query = "SELECT * FROM `subject`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        return $resultSet;
    }

    public function findSubjectsByGrade(int $gradeId)
    {
        $isGrade = true; // TODO

        if ($isGrade == true) {
            $query = "SELECT * FROM `subject` WHERE `gradeId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$gradeId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
    }

    public function save(Subject $subject)
    {
        $query = "INSERT INTO `subject` (`name` `grade_id`, `teacher_id`) VALUES ( ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$subject->getName(), $subject->getGrade()->getId(), $subject->getTeacher()->getId()]);
        return true;
    }
}