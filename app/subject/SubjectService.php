<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/subject/SubjectRepository.php';

class SubjectService
{
    private SubjectRepository $subjectRepository;

    public function __construct()
    {
        $this->subjectRepository = new SubjectRepository();
    }

    public function getSubjectById(int $subjectId)
    {
        $subjectArray = $this->subjectRepository->findSubjectById($subjectId);
        $subject = new Subject();
        $subject->setId($subjectArray['id']);
        $subject->setName($subjectArray['name']);
        return $subject;
    }

    
}