<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/file/File.php";
require_once $ROOT . "/app/file/ImageDirectory.php";
require_once $ROOT . "/app/file/FileDirectory.php";
require_once $ROOT . '/app/answer_sheet/AnswerSheet.php';
require_once $ROOT . '/app/answer_sheet/AnswerSheetRepository.php';

class AnswerSheetService
{
    private AnswerSheetRepository $answerSheetRepository;
    private ImageDirectory $imageDirectory;
    private FileDirectory $fileDirectory;
    private File $answerSheetFile;

    public function __construct()
    {
        $this->answerSheetRepository = new AnswerSheetRepository();
        $this->fileDirectory = new FileDirectory();
        $this->fileDirectory->setAllowedExtensions(['pdf', 'doc', 'docx']);
    }

    public function setFile($file)
    {
        $targetDir = '/uploads/images/';
        $this->answerSheetFile = new File($file['name'], $file['type'], $file['full_path'], $file['tmp_name'], $file['error'], $file['size'], $targetDir);
    }

    public function getAnswerSheetById(int $answerSheetId)
    {
        $this->answerSheetRepository->findAnswerSheetById($answerSheetId);
    }

    public function upload()
    {
        $this->fileDirectory->uploadFile($this->answerSheetFile);
        echo $this->answerSheetFile->getDownloadFile() . "<br>";
    }

    public function save($file, $assignmentId, $studentId)
    {
        $answerSheet = new AnswerSheet();
        $answerSheet->setFile($this->answerSheetFile->getTargetFile());
        // $answerSheet->setAssignment();
        // $answerSheet->setStudent();
    }
}