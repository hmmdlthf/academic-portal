<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/note/NoteRepository.php';
require_once $ROOT . '/app/note/Note.php';
require_once $ROOT . '/app/lesson/LessonService.php';
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';
require_once $ROOT . '/app/file/File.php';
require_once $ROOT . '/app/file/FileDirectory.php';

class NoteService
{
    private NoteRepository $noteRepository;
    private FileDirectory $fileDirectory;
    private File $noteFile;

    public function __construct()
    {
        $this->noteRepository = new NoteRepository();
        $this->fileDirectory = new FileDirectory();
        $this->fileDirectory->setAllowedExtensions(['pdf', 'doc', 'docx', 'txt', 'png']);
    }

    public function getNoteById(int $noteId)
    {
        return $this->noteRepository->findNoteById($noteId);
    }

    public function setFile($file)
    {
        $targetDir = '/uploads/notes/';
        $this->noteFile = new File($file['name'], $file['type'], $file['full_path'], $file['tmp_name'], $file['error'], $file['size'], $targetDir);
    }

    public function upload()
    {
        $this->fileDirectory->uploadFile($this->noteFile);
        echo $this->noteFile->getDownloadFile() . "<br>";
    }

    public function getNotes()
    {
        return $this->noteRepository->findNotes();
    }

    public function getNotesByTeacherUsername(string $teacherUsername)
    {
        return $this->noteRepository->findNotesByTeacher((new TeacherService())->getTeacherByUsername($teacherUsername));
    }

    public function getNotesByStudentUsername(string $studentUsername)
    {
        return $this->noteRepository->findNotesByStudent((new StudentService())->getStudentByUsername($studentUsername));
    }

    public function save($name, $lessonId)
    {
        $note = new Note();
        $note->setName($name);
        $note->setFile($this->noteFile->getShortFile());
        $lesson = new LessonService();
        $note->setLesson($lesson->getLessonById($lessonId));
        $this->noteRepository->save($note);
    }

    public function update($id, $name, $file)
    {
        $note = $this->getNoteById($id);
        if ($note == false) {
            echo ("note not found");
            return false;
        }
        
        $note->setName($name);
        if (!empty($file)) {
            $note->setFile($file);
        }
        $this->noteRepository->update($note);
    }

    public function delete($id)
    {
        $note = $this->getNoteById($id);
        if ($note == false) {
            echo ("note not found");
            return false;
        }
        $this->noteRepository->delete($note);
    }

    public function count()
    {
        return $this->noteRepository->count();
    }

    
}