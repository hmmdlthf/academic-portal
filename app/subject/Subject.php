<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/grade/Grade.php";
require_once $ROOT . "/app/teacher/Teacher.php";

class Subject 
{
    private $id;
    private $name;
    private Grade $grade;
    private Teacher $teacher;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return  $this->name;
    }

    public function getGrade()
    {
        return $this->grade;
    }

    public function getTeacher()
    {
        return $this->teacher;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setGrade(Grade $grade)
    {
        $this->grade = $grade;
    }

    public function setTeacher(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }
}