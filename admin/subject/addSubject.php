<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/grade/Grade.php';
require_once $ROOT . '/app/grade/GradeService.php';
require_once $ROOT . '/app/teacher/Teacher.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$gradeService = new GradeService();
$grades = $gradeService->getGrades();

$teacherService = new TeacherService();
$teachers = $teacherService->getTeachers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Add Subject</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <form action="addSubjectProcess.php?link=add%20subject" method="post">
                    <div class="form__group">
                        <div class="form__control">
                            <label for="grade">grade</label><select name="grade" id="grade" placeholder="Select Grade">
                                <?php foreach ($grades as $grade) { ?>
                                    <option value="<?php echo $grade->getId(); ?>"><?php echo $grade->getName(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="teacher">Teacher</label><select name="teacher" id="teacher" placeholder="Select Teacher">
                                <?php foreach ($teachers as $teacher) { ?>
                                    <option value="<?php echo $teacher->getId(); ?>"><?php echo $teacher->getEmail(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <label for="name">Name</label>
                            <input type="text" name="name" placeholder="Subject Name" id="name">
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__control">
                            <button class="btn btn__primary" type="submit">Add Subject</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>