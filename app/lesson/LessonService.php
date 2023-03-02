<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/lesson/LessonRepository.php';

class LessonService
{
    private LessonRepository $lessonRepository;

    public function __construct()
    {
        $this->lessonRepository = new LessonRepository();
    }

    public function getLessonById(int $lessonId)
    {
        $lessonArray = $this->lessonRepository->findLessonById($lessonId);
        $lesson = new Lesson();
        $lesson->setId($lessonArray['id']);
        $lesson->setName($lessonArray['name']);
        $subject = new SubjectService();
        $lesson->setSubject($subject->getSubjectById($lessonArray['subject_id']));
        return $lesson;
    }
}