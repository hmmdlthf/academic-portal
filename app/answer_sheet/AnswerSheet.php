<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class AnswerSheet extends Db
{
    private $id;
    private $file;
    private $marks;
    private $isReleased;
    private Assignment $assignment;
    private Student $student;

    public function getId()
    {
        return $this->id;
    }

    public function getFile()
    {
        return  $this->file;
    }

    public function getMarks()
    {
        return $this->marks;
    }

    public function getIsReleased()
    {
        return $this->isReleased;
    }

    public function getAssignment()
    {
        return $this->assignment;
    }

    public function getStudent()
    {
        return $this->student;
    }

    public function setFile(string $file)
    {
        $this->file = $file;
    }

    public function setAssignment(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }

    public function setStudent(Student $student)
    {
        $this->student = $student;
    }

}