<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Lesson extends Db
{
    private $id;
    private $name;
    private Subject $subject;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return  $this->name;
    }

    public function getSubjec()
    {
        return $this->subject;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}