<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/subject/SubjectRepository.php';
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';

class SubjectService
{
    private SubjectRepository $subjectRepository;

    public function __construct()
    {
        $this->subjectRepository = new SubjectRepository();
    }

    public function getSubjectById(int $subjectId)
    {
        return $this->subjectRepository->findSubjectById($subjectId);
    }

    public function getSubjectByName(string $name)
    {
        return $this->subjectRepository->findSubjectByName($name);
    }

    public function getSubjects()
    {
        return $this->subjectRepository->findSubjects();
    }

    public function getSubjectsByTeacherUsername(string $teacherUsername)
    {
        $teacherService = new TeacherService();
        $teacher = $teacherService->getTeacherByUsername($teacherUsername);
        return $this->subjectRepository->findSubjectsByTeacher($teacher);
    }

    public function getSubjectsByStudentUsername(string $studentUsername)
    {
        $studentService = new StudentService();
        $student = $studentService->getStudentByUsername($studentUsername);
        return $this->subjectRepository->findSubjectsByStudent($student);
    }

    public function save($name, $gradeId, $teacherId)
    {
        if ($this->getSubjectByName($name) !== false) {
            echo ("subject already exists");
            return false;
        }   
        $subject = new Subject();
        $subject->setName($name);
        $grade = new GradeService();
        $subject->setGrade($grade->getGradeById($gradeId));
        $teacher = new TeacherService();
        $subject->setTeacher($teacher->getTeacherById($teacherId));
        $this->subjectRepository->save($subject);
    }

    public function update($id, $name)
    {
        $subject = $this->getSubjectById($id);
        if ($subject == false) {
            echo ("subject not found");
            return false;
        }
        $subject->setName($name);
        $this->subjectRepository->update($subject);
    }

    public function delete($id)
    {
        $subject = $this->getSubjectById($id);
        if ($subject == false) {
            echo ("subject not found");
            return false;
        }
        $this->subjectRepository->delete($subject);
    }

    public function count()
    {
        return $this->subjectRepository->count();
    }
}