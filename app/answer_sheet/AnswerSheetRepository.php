<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class AnswerSheetRepository extends Db
{
    public function findAnswerSheetById(int $id)
    {
        $query = "SELECT * FROM `answer_sheet` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
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
        return $resultSet;
    }

    public function save(AnswerSheet $answerSheet)
    {
        $query = "INSERT INTO `answer_sheet` (`file` `assignment_id`, `student_id`) VALUES ( ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$answerSheet->getFile(), $answerSheet->getAssignment()->getId(), $answerSheet->getStudent()->getId()]);
        return true;
    }
}