<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/assignment/AssignmentRepository.php';
require_once $ROOT . '/app/teacher/TeacherService.php';
require_once $ROOT . '/app/file/FileDirectory.php';
require_once $ROOT . '/app/file/File.php';

class AssignmentService
{
    private AssignmentRepository $assignmentRepository;
    private FileDirectory $fileDirectory;
    private File $assignmentFile;

    public function __construct()
    {
        $this->assignmentRepository = new AssignmentRepository();
        $this->fileDirectory = new FileDirectory();
        $this->fileDirectory->setAllowedExtensions(['pdf', 'doc', 'docx', 'txt', 'png']);
    }

    public function getAssignmentById(int $assignmentId)
    {
        return $this->assignmentRepository->findAssignmentById($assignmentId);
    }

    public function setFile($file)
    {
        $targetDir = '/uploads/assignments/';
        $this->assignmentFile = new File($file['name'], $file['type'], $file['full_path'], $file['tmp_name'], $file['error'], $file['size'], $targetDir);
    }

    public function upload()
    {
        $this->fileDirectory->uploadFile($this->assignmentFile);
        echo $this->assignmentFile->getDownloadFile() . "<br>";
    }

    public function getAssignments()
    {
        return $this->assignmentRepository->findAssignments();
    }

    public function getAssignmentsCountByLesson(int $lessonId)
    {
        return $this->assignmentRepository->findAssignmentsCountByLesson($lessonId);
    }

    public function getAssignmentsByTeacherUsername(string $teacherUsername)
    {
        return $this->assignmentRepository->findAssignmentsByTeacher((new TeacherService())->getTeacherByUsername($teacherUsername));
    }

    public function getAssignmentsByStudentUsername(string $studentUsername)
    {
        return $this->assignmentRepository->findAssignmentsByStudent((new StudentService())->getStudentByUsername($studentUsername));
    }

    public function save($lessonId)
    {
        $assignment = new Assignment();
        $assignment->setFile($this->assignmentFile->getShortFile());
        $lesson = new LessonService();
        $assignment->setLesson($lesson->getLessonById($lessonId));
        $this->assignmentRepository->save($assignment);
    }

    public function update($id, $file)
    {
        $assignment = $this->getAssignmentById($id);
        if ($assignment == false) {
            echo ("assignment not found");
            return false;
        }
        $assignment->setFile($file);
        $this->assignmentRepository->update($assignment);
    }

    public function delete($id)
    {
        $assignment = $this->getAssignmentById($id);
        if ($assignment == false) {
            echo ("assignment not found");
            return false;
        }
        unlink($assignment->getTargetFile());
        $this->assignmentRepository->delete($assignment);
    }

    public function count()
    {
        return $this->assignmentRepository->count();
    }
}