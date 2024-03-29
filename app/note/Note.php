<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Note extends Db
{
    private $id;
    private $name;
    private string $file;
    private Lesson $lesson;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return  $this->name;
    }
    
    public function getFile()
    {
        return $this->file;
    }

    public function getTargetFile(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . $this->file;
    }

    public function getLesson()
    {
        return $this->lesson;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setFile(string $file)
    {
        $this->file = $file;
    }

    public function setLesson(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }
}