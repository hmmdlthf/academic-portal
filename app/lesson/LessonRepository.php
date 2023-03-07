<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class LessonRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $lesson = new Lesson();
        $lesson->setId($array['id']);
        $lesson->setName($array['name']);
        $subject = new SubjectService();
        $lesson->setSubject($subject->getSubjectById($array['subject_id']));
        return $lesson;
    }
    
    public function findLessonById(int $id)
    {
        $query = "SELECT * FROM `lesson` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findLessonByName(string $name)
    {
        $query = "SELECT * FROM `lesson` WHERE `name`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$name]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
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
        $lessons = [];

        if ($resultSet > 0) {
            foreach($resultSet as $lessonArray) {
                $lesson = $this->addDetailsToModel($lessonArray);
                $lessons[] = $lesson;
            }
            return $lessons;
        } else {
            return false;
        }
    }

    public function findLessonsBySubject(int $subjectId)
    {
        $query = "SELECT * FROM `lesson` WHERE `subjectId`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$subjectId]);
        $resultSet = $statement->fetchAll();
        $lessons = [];

        if ($resultSet > 0) {
            foreach($resultSet as $lessonArray) {
                $lesson = $this->addDetailsToModel($lessonArray);
                $lessons[] = $lesson;
            }
            return $lessons;
        } else {
            return false;
        }
    }

    public function save(Lesson $lesson)
    {
        $query = "INSERT INTO `lesson` (`name`, `subject_id`) VALUES ( ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$lesson->getName(), $lesson->getSubject()->getId()]);
        return true;
    }

    public function update(Lesson $lesson)
    {
        $query = "UPDATE `lesson` SET `name`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$lesson->getName(), $lesson->getId()]);
        return true;
    }

    public function delete(Lesson $lesson)
    {
        $query = "DELETE FROM `lesson` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$lesson->getId()]);
    }
}