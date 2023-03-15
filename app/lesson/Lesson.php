<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Lesson extends Db
{
    private $id;
    private $name;
    private Subject $subject;
    private int $notesCount;
    private int $assignmentCount;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return  $this->name;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getNotesCount()
    {
        return $this->notesCount;
    }

    public function getAssignmentCount()
    {
        return $this->assignmentCount;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setSubject(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function setNotesCount(int $notesCount)
    {
        $this->notesCount = $notesCount;
    }

    public function setAssignmentCount(int $assignmentCount)
    {
        $this->assignmentCount = $assignmentCount;
    }
}