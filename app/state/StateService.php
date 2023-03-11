<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/state/StateRepository.php';

class StateService
{
    private StateRepository $stateRepository;

    public function __construct()
    {
        $this->stateRepository = new StateRepository();
    }

    public function getStateById(int $stateId)
    {
        return $this->stateRepository->findStateById($stateId);
    }

    public function getStateByName(string $name)
    {
        return $this->stateRepository->findStateByName($name);
    }

    public function getStates()
    {
        return $this->stateRepository->findStates();
    }

    public function save($name, $countryId)
    {
        if ($this->getStateByName($name) !== false) {
            echo ("state already exists");
            return false;
        }   
        $state = new State();
        $state->setName($name);
        $country = new CountryService();
        $state->setCountry($country->getCountryById($countryId));
        $this->stateRepository->save($state);
    }

    public function update($id, $name)
    {
        $state = $this->getStateById($id);
        if ($state == false) {
            echo ("state not found");
            return false;
        }
        $state->setName($name);
        $this->stateRepository->update($state);
    }

    public function delete($id)
    {
        $state = $this->getStateById($id);
        if ($state == false) {
            echo ("state not found");
            return false;
        }
        $this->stateRepository->delete($state);
    }

    public function count()
    {
        return $this->stateRepository->count();
    }
}