<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/assignment/AssignmentRepository.php';
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

    public function save($name, $lessonId)
    {
        $assignment = new Assignment();
        $assignment->setName($name);
        $assignment->setFile($this->assignmentFile->getShortFile());
        $lesson = new LessonService();
        $assignment->setLesson($lesson->getLessonById($lessonId));
        $this->assignmentRepository->save($assignment);
    }

    public function update($id, $name, $file)
    {
        $assignment = $this->getAssignmentById($id);
        if ($assignment == false) {
            echo ("assignment not found");
            return false;
        }
        $assignment->setName($name);
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
        $this->assignmentRepository->delete($assignment);
    }
}