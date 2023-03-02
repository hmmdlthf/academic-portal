<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Note extends Db
{
    private $id;
    private $name;
    private Lesson $lesson;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return  $this->name;
    }

    public function getLesson()
    {
        return $this->lesson;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}