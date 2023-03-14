<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/assignment/Assignment.php";
require_once $ROOT . "/app/student/Student.php";

class AnswerSheet extends Db
{
    private $id;
    private string $file;
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

    public function getTargetFile(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . $this->file;
    }

    public function getMarks()
    {
        return $this->marks;
    }

    public function getIsReleased()
    {
        return $this->isReleased;
    }

    public function getStatus()
    {
        if ($this->isReleased == true) {
            return 'Released';
        } else {
            return 'Not Released';
        }
    }

    public function getAssignment()
    {
        return $this->assignment;
    }

    public function getStudent()
    {
        return $this->student;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setFile(string $file)
    {
        $this->file = $file;
    }

    public function setMarks($marks)
    {
        $this->marks = $marks;
    }

    public function setIsReleased($isReleased)
    {
        $this->isReleased = $isReleased;
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