<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/answerSheet/AnswerSheetRepository.php';

class AnswerSheetService
{
    private AnswerSheetRepository $answerSheetRepository;

    public function __construct(AnswerSheetRepository $answerSheetRepository)
    {
        $this->answerSheetRepository = $answerSheetRepository;
    }

    public function getAnswerSheetById(int $answerSheetId)
    {
        $this->answerSheetRepository->findAnswerSheetById($answerSheetId);
    }

    public function upload()
    {
        
    }

    public function save($file, $assignmentId, $studentId)
    {
        $answerSheet = new AnswerSheet();
        $answerSheet->setFile($file);
        

    }
}