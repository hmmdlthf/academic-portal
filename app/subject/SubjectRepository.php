<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/subject/Subject.php";
require_once $ROOT . "/app/grade/GradeService.php";

class SubjectRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $subject = new Subject();
        $subject->setId($array['id']);
        $subject->setName($array['name']);
        $grade = new GradeService();
        $subject->setGrade($grade->getGradeById($array['grade_id']));
        $teacher = new TeacherService();
        $subject->setTeacher($teacher->getTeacherById($array['teacher_id']));
        return $subject;
    }
    
    public function findSubjectById(int $id)
    {
        $query = "SELECT * FROM `subject` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findSubjectByName(string $name)
    {
        $query = "SELECT * FROM `subject` WHERE `name`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$name]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
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
        $subjects = [];

        if ($resultSet > 0) {
            foreach($resultSet as $subjectArray) {
                $subject = $this->addDetailsToModel($subjectArray);
                $subjects[] = $subject;
            }
            return $subjects;
        } else {
            return false;
        }
    }

    public function findSubjectsByGrade(int $gradeId)
    {
        $query = "SELECT * FROM `subject` WHERE `gradeId`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$gradeId]);
        $resultSet = $statement->fetchAll();
        $subjects = [];

        if ($resultSet > 0) {
            foreach($resultSet as $subjectArray) {
                $subject = $this->addDetailsToModel($subjectArray);
                $subjects[] = $subject;
            }
            return $subjects;
        } else {
            return false;
        }
    }

    public function save(Subject $subject)
    {
        $query = "INSERT INTO `subject` (`name`, `grade_id`, `teacher_id`) VALUES ( ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$subject->getName(), $subject->getGrade()->getId(), $subject->getTeacher()->getId()]);
        return true;
    }

    public function update(Subject $subject)
    {
        $query = "UPDATE `subject` SET `name`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$subject->getName(), $subject->getId()]);
        return true;
    }

    public function delete(Subject $subject)
    {
        $query = "DELETE FROM `subject` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$subject->getId()]);
    }
}