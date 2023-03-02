<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/grade/GradeRepository.php';

class GradeService
{
    private GradeRepository $gradeRepository;

    public function __construct(GradeRepository $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }

    public function getGradeById(int $gradeId)
    {
        $this->gradeRepository->findGradeById($gradeId);
    }
}