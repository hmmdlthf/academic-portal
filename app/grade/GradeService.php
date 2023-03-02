<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeRepository.php';

class GradeService
{
    private GradeRepository $gradeRepository;

    public function __construct()
    {
        $this->gradeRepository = new GradeRepository();
    }

    public function getGradeById(int $gradeId)
    {
        return $this->gradeRepository->findGradeById($gradeId);
    }
}