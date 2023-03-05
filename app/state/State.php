<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class State extends Db
{
    private $id;
    private $name;
    private Country $country;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return  $this->name;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setCountry(Country $country)
    {
        $this->country = $country;
    }
}