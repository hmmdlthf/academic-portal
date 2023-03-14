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

    public function getGradeByName(string $name)
    {
        return $this->gradeRepository->findGradeByName($name);
    }

    public function getGrades()
    {
        return $this->gradeRepository->findGrades();
    }

    public function save($name)
    {
        if ($this->getGradeByName($name) !== false) {
            echo ("grade already exists");
            return false;
        }   
        $grade = new Grade();
        $grade->setName($name);
        $grade->setOrder($this->getLastGradeOrder() + 1);
        $this->gradeRepository->save($grade);
    }

    public function update($id, $name)
    {
        $grade = $this->getGradeById($id);
        if ($grade == false) {
            echo ("grade not found");
            return false;
        }
        $grade->setName($name);
        $this->gradeRepository->update($grade);
    }

    public function delete($id)
    {
        $grade = $this->getGradeById($id);
        if ($grade == false) {
            echo ("grade not found");
            return false;
        }
        $this->gradeRepository->delete($grade);
    }

    public function count()
    {
        return $this->gradeRepository->count();
    }

    public function getLastGradeOrder()
    {
        return $this->gradeRepository->findLastGradeOrder()['MAX(`order`)'];
    }

    public function getGradesBelow(int $currentGradeId)
    {
        return $this->gradeRepository->findAllGradesBellow($this->getGradeById($currentGradeId));
    }
}