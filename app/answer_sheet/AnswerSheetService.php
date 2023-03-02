<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/file/File.php";
require_once $ROOT . "/app/file/ImageDirectory.php";
require_once $ROOT . '/app/answer_sheet/AnswerSheetRepository.php';

class AnswerSheetService
{
    private AnswerSheetRepository $answerSheetRepository;
    private ImageDirectory $imageDirectory;
    private File $answerSheetFile;

    public function __construct()
    {
        $this->answerSheetRepository = new AnswerSheetRepository();
        $this->imageDirectory = new ImageDirectory();
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
        $this->imageDirectory->uploadFile($this->answerSheetFile);
        echo $this->answerSheetFile->getDownloadFile() . "<br>";
    }

    public function save(File $file, $assignmentId, $studentId)
    {
        $answerSheet = new AnswerSheet();
        $answerSheet->setFile($file->getTargetFile());
    }
}