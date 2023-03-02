<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Assignment extends Db
{
    private $id;
    private $name;
    private File $file;
    private Lesson $lesson;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return  $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

}