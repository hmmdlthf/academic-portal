<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/assignment/Assignment.php";
require_once $ROOT . "/app/lesson/LessonService.php";

class AssignmentRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $assignment = new Assignment();
        $assignment->setId($array['id']);
        $assignment->setFile($array['file']);
        $lesson = new LessonService();
        $assignment->setLesson($lesson->getLessonById($array['lesson_id']));
        return $assignment;
    }
    
    public function findAssignmentById(int $id)
    {
        $query = "SELECT * FROM `assignment` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findAssignments()
    {
        $query = "SELECT * FROM `assignment`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $assignments = [];

        if ($resultSet > 0) {
            foreach($resultSet as $assignmentsArray) {
                $assignment = $this->addDetailsToModel($assignmentsArray);
                $assignments[] = $assignment;
            }
            return $assignments;
        } else {
            return false;
        }
    }

    public function findAssignmentsByLesson(int $lessonId)
    {
        $query = "SELECT * FROM `assignment` WHERE `lessonId`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$lessonId]);
        $resultSet = $statement->fetchAll();
        $assignments = [];

        if ($resultSet > 0) {
            foreach($resultSet as $assignmentsArray) {
                $assignment = $this->addDetailsToModel($assignmentsArray);
                $assignments[] = $assignment;
            }
            return $assignments;
        } else {
            return false;
        }
    }

    public function save(Assignment $assignment)
    {
        $query = "INSERT INTO `assignment` (`file`, `lesson_id`) VALUES ( ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$assignment->getFile() , $assignment->getLesson()->getId()]);
        return true;
    }

    public function update(Assignment $assignment)
    {
        $query = "UPDATE `assignment` SET `file`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$assignment->getFile(), $assignment->getId()]);
        return true;
    }

    public function delete(Assignment $assignment)
    {
        $query = "DELETE FROM `assignment` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$assignment->getId()]);
    }
}