<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/file/File.php";
require_once $ROOT . "/app/file/ImageDirectory.php";
require_once $ROOT . "/app/file/FileDirectory.php";
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetRepository.php';
require_once $ROOT . '/app/utils/boolean.php';

class AnswerSheetService
{
    private AnswerSheetRepository $answerSheetRepository;
    private FileDirectory $fileDirectory;
    private File $answerSheetFile;

    public function __construct()
    {
        $this->answerSheetRepository = new AnswerSheetRepository();
        $this->fileDirectory = new FileDirectory();
        $this->fileDirectory->setAllowedExtensions(['pdf', 'doc', 'docx', 'txt', 'png']);
    }

    public function getAnswerSheetById(int $answerSheetId)
    {
        return $this->answerSheetRepository->findAnswerSheetById($answerSheetId);
    }

    public function setFile($file)
    {
        $targetDir = '/uploads/answerSheets/';
        $this->answerSheetFile = new File($file['name'], $file['type'], $file['full_path'], $file['tmp_name'], $file['error'], $file['size'], $targetDir);
    }

    public function upload()
    {
        $this->fileDirectory->uploadFile($this->answerSheetFile);
        echo $this->answerSheetFile->getDownloadFile() . "<br>";
    }

    public function getAnswerSheets()
    {
        return $this->answerSheetRepository->findAnswerSheets();
    }

    public function getAnswerSheetsByTeacherUsername(string $teacherUsername)
    {
        return $this->answerSheetRepository->findAnswerSheetsByTeacher((new TeacherService())->getTeacherByUsername($teacherUsername));
    }
    
    public function getAnswerSheetsByStudentUsername(string $studentUsername)
    {
        return $this->answerSheetRepository->findAnswerSheetsByStudent((new StudentService())->getStudentByUsername($studentUsername));
    }

    public function save($assignmentId, $studentId)
    {
        $answerSheet = new AnswerSheet();
        $answerSheet->setFile($this->answerSheetFile->getShortFile());
        $answerSheet->setIsReleased(false);
        $assignment = new AssignmentService();
        $answerSheet->setAssignment($assignment->getAssignmentById($assignmentId));
        $student = new StudentService();
        $answerSheet->setStudent($student->getStudentById($studentId));
        $this->answerSheetRepository->save($answerSheet);
    }

    public function update($id, $file)
    {
        $answerSheet = $this->getAnswerSheetById($id);
        if ($answerSheet == false) {
            echo ("answerSheet not found");
            return false;
        }
        $answerSheet->setFile($file);
        $this->answerSheetRepository->update($answerSheet);
    }

    public function updateMarks($id, $marks)
    {
        $answerSheet = $this->getAnswerSheetById($id);
        if ($answerSheet == false) {
            echo ("answerSheet not found");
            return false;
        }
        $answerSheet->setMarks($marks);
        $this->answerSheetRepository->updateMarks($answerSheet);
    }

    public function delete($id)
    {
        $answerSheet = $this->getAnswerSheetById($id);
        if ($answerSheet == false) {
            echo ("answerSheet not found");
            return false;
        }
        unlink($answerSheet->getTargetFile());
        $this->answerSheetRepository->delete($answerSheet);
    }

    public function count()
    {
        return $this->answerSheetRepository->count();
    }
}