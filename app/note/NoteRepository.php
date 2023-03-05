<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/note/Note.php";

class NoteRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $note = new Note();
        $note->setId($array['id']);
        $note->setName($array['name']);
        $lesson = new LessonService();
        $note->setLesson($lesson->getLessonById($array['lesson_id']));
        return $note;
    }
    
    public function findNoteById(int $id)
    {
        $query = "SELECT * FROM `note` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
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
        $notes = [];

        if ($resultSet > 0) {
            foreach($resultSet as $notesArray) {
                $note = $this->addDetailsToModel($notesArray);
                $notes[] = $note;
            }
            return $notes;
        } else {
            return false;
        }
    }

    public function findNotesByLesson(int $lessonId)
    {
        $query = "SELECT * FROM `note` WHERE `lessonId`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$lessonId]);
        $resultSet = $statement->fetchAll();
        $notes = [];

        if ($resultSet > 0) {
            foreach($resultSet as $notesArray) {
                $note = $this->addDetailsToModel($notesArray);
                $notes[] = $note;
            }
            return $notes;
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

    public function update(Note $note)
    {
        $query = "UPDATE `note` SET `name`=?, `file`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$note->getName(), $note->getFile(), $note->getId()]);
        return true;
    }

    public function delete(Note $note)
    {
        $query = "DELETE FROM `note` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$note->getId()]);
    }
}