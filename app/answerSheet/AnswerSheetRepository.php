<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/answerSheet/AnswerSheet.php";
require_once $ROOT . "/app/assignment/AssignmentService.php";
require_once $ROOT . "/app/student/StudentService.php";
require_once $ROOT . "/app/utils/boolean.php";

class AnswerSheetRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $answerSheet = new AnswerSheet();
        $answerSheet->setId($array['id']);
        $answerSheet->setFile($array['file']);
        $answerSheet->setMarks($array['marks']);
        $answerSheet->setIsReleased(getBool($array['is_released']));
        $assignment = new AssignmentService();
        $answerSheet->setAssignment($assignment->getAssignmentById($array['assignment_id']));
        $student = new StudentService();
        $answerSheet->setStudent($student->getStudentById($array['student_id']));
        return $answerSheet;
    }
    
    public function findAnswerSheetById(int $id)
    {
        $query = "SELECT * FROM `answer_sheet` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findAnswerSheets()
    {
        $query = "SELECT * FROM `answer_sheet`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $answerSheets = [];

        if ($resultSet > 0) {
            foreach($resultSet as $answerSheetsArray) {
                $answerSheet = $this->addDetailsToModel($answerSheetsArray);
                $answerSheets[] = $answerSheet;
            }
            return $answerSheets;
        } else {
            return false;
        }
    }

    public function findAnswerSheetsByAssignment(int $assignmentId)
    {
        $query = "SELECT * FROM `answer_sheet` WHERE `assignment_id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$assignmentId]);
        $resultSet = $statement->fetchAll();
        $answerSheets = [];

        if ($resultSet > 0) {
            foreach($resultSet as $answerSheetsArray) {
                $answerSheet = $this->addDetailsToModel($answerSheetsArray);
                $answerSheets[] = $answerSheet;
            }
            return $answerSheets;
        } else {
            return false;
        }
    }

    public function findAnswerSheetsByStudent(Student $student)
    {
        $query = "SELECT * FROM `answer_sheet` WHERE `student_id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$student->getId()]);
        $resultSet = $statement->fetchAll();
        $answerSheets = [];

        if ($resultSet > 0) {
            foreach($resultSet as $answerSheetsArray) {
                $answerSheet = $this->addDetailsToModel($answerSheetsArray);
                $answerSheets[] = $answerSheet;
            }
            return $answerSheets;
        } else {
            return false;
        }
    }

    public function findAnswerSheetsByTeacher(Teacher $teacher)
    {
        $query = "SELECT `answer_sheet`.`id`, `answer_sheet`.`file`, `answer_sheet`.`marks`, `answer_sheet`.`is_released`, `answer_sheet`.`assignment_id`, `answer_sheet`.`student_id` FROM (`answer_sheet` INNER JOIN `assignment` ON `answer_sheet`.`assignment_id`=`assignment`.`id` INNER JOIN `lesson` ON `assignment`.`lesson_id`=`lesson`.`id` INNER JOIN `subject` ON `lesson`.`subject_id`=`subject`.`id`) WHERE `teacher_id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$teacher->getId()]);
        $resultSet = $statement->fetchAll();
        $answerSheets = [];

        if ($resultSet > 0) {
            foreach($resultSet as $answerSheetsArray) {
                $answerSheet = $this->addDetailsToModel($answerSheetsArray);
                $answerSheets[] = $answerSheet;
            }
            return $answerSheets;
        } else {
            return false;
        }
    }

    public function save(AnswerSheet $answerSheet)
    {
        $query = "INSERT INTO `answer_sheet` (`file`, `is_released`, `assignment_id`, `student_id`) VALUES ( ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$answerSheet->getFile(), getTinyInt($answerSheet->getIsReleased()), $answerSheet->getAssignment()->getId(), $answerSheet->getStudent()->getId()]);
        return true;
    }

    public function update(AnswerSheet $answerSheet)
    {
        $query = "UPDATE `answer_sheet` SET `file`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$answerSheet->getFile(), $answerSheet->getId()]);
        return true;
    }

    public function updateMarks(AnswerSheet $answerSheet)
    {
        $query = "UPDATE `answer_sheet` SET `marks`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$answerSheet->getMarks(), $answerSheet->getId()]);
        return true;
    }

    public function delete(AnswerSheet $answerSheet)
    {
        $query = "DELETE FROM `answer_sheet` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$answerSheet->getId()]);
    }

    public function count()
    {
        $query = "SELECT COUNT(*) FROM `answer_sheet`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetch();
        return $resultSet['COUNT(*)'];
    }
}