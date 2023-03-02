<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/officer/OfficerRepository.php';

class OfficerService
{
    private OfficerRepository $officerRepository;

    public function __construct(OfficerRepository $officerRepository)
    {
        $this->officerRepository = $officerRepository;
    }

    public function getOfficerById(int $officerId)
    {
        $this->officerRepository->findOfficerById($officerId);
    }
}