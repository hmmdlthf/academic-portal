<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/state/State.php";
require_once $ROOT . "/app/country/CountryService.php";

class StateRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $state = new State();
        $state->setId($array['id']);
        $state->setName($array['name']);
        $country = new CountryService();
        $state->setCountry($country->getCountryById($array['country_id']));
        return $state;
    }

    public function findStateById(int $id)
    {
        $query = "SELECT * FROM `state` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findStateByName(string $name)
    {
        $query = "SELECT * FROM `state` WHERE `name`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$name]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findStates()
    {
        $query = "SELECT * FROM `state`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $states = [];

        if ($resultSet > 0) {
            foreach($resultSet as $stateArray) {
                $state = $this->addDetailsToModel($stateArray);
                $states[] = $state;
            }
            return $states;
        } else {
            return false;
        }
    }

    public function save(State $state)
    {
        $query = "INSERT INTO `state` (`name`, `country_id`) VALUES (?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$state->getName(), $state->getCountry()->getId()]);
        return true;
    }

    public function update(State $state)
    {
        $query = "UPDATE `state` SET `name`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$state->getName(), $state->getId()]);
        return true;
    }

    public function delete(State $state)
    {
        $query = "DELETE FROM `state` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$state->getId()]);
    }

    public function count()
    {
        $query = "SELECT COUNT(*) FROM `state`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetch();
        return $resultSet['COUNT(*)'];
    }
}