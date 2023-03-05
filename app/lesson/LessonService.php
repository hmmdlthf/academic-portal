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
        return $this->lessonRepository->findLessonById($lessonId);
    }

    public function getLessonByName(string $name)
    {
        return $this->lessonRepository->findLessonByName($name);
    }

    public function getLessons()
    {
        return $this->lessonRepository->findLessons();
    }

    public function save($name, $subjectId)
    {
        if ($this->getLessonByName($name) !== false) {
            echo ("lesson already exists");
            return false;
        }   
        $lesson = new Lesson();
        $lesson->setName($name);
        $subject = new SubjectService();
        $lesson->setSubject($subject->getSubjectById($subjectId));
        $this->lessonRepository->save($lesson);
    }

    public function update($id, $name)
    {
        $lesson = $this->getLessonById($id);
        if ($lesson == false) {
            echo ("lesson not found");
            return false;
        }
        $lesson->setName($name);
        $this->lessonRepository->update($lesson);
    }

    public function delete($id)
    {
        $lesson = $this->getLessonById($id);
        if ($lesson == false) {
            echo ("lesson not found");
            return false;
        }
        $this->lessonRepository->delete($lesson);
    }
}