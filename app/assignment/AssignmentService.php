<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/assignment/AssignmentRepository.php';

class AssignmentService
{
    private AssignmentRepository $assignmentRepository;

    public function __construct(AssignmentRepository $assignmentRepository)
    {
        $this->assignmentRepository = $assignmentRepository;
    }

    public function getAssignmentById(int $assignmentId)
    {
        $this->assignmentRepository->findAssignmentById($assignmentId);
    }
}