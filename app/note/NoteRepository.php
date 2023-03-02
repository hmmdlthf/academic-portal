<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/note/Note.php";

class NoteRepository extends Db
{
    public function findNoteById(int $id)
    {
        $query = "SELECT * FROM `note` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function findNotes()
    {
        $query = "SELECT * FROM `note`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        return $resultSet;
    }

    public function findNotesByLesson(int $lessonId)
    {
        $isLesson = true; // TODO

        if ($isLesson == true) {
            $query = "SELECT * FROM `note` WHERE `lessonId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$lessonId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
    }

    public function save(Note $note)
    {
        $query = "INSERT INTO `note` (`name` `file`, `lesson_id`) VALUES ( ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$note->getName(), $note->getFile()->getTargetFile(), $note->getLesson()->getId()]);
        return true;
    }
}