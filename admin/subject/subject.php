<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/subject/SubjectService.php';

$jwtService = jwt_start(['admin_role']);

$subjects = (new SubjectService())->getSubjects();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Subject</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <?php if (count($subjects) > 0) { ?>
                    <div class="filters">
                    <div class="form__group">
                            <div class="form__control">
                                <select name="grade" id="grade">
                                    <option value="">grade1</option>
                                    <option value="">grade2</option>
                                    <option value="">grade3</option>
                                </select>
                            </div>
                            <div class="form__control">
                                <select name="teacher" id="teacher">
                                    <option value="">teacher1</option>
                                    <option value="">teacher2</option>
                                    <option value="">teacher3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="form__control">
                                <input type="text" name="name" placeholder="Name" id="">
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Grade</th>
                                    <th>Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subjects as $subject) { ?>
                                    <tr>
                                        <td><?php echo $subject->getId(); ?></td>
                                        <td><?php echo $subject->getName(); ?></td>
                                        <td><?php echo $subject->getGrade()->getName(); ?></td>
                                        <td><?php echo $subject->getTeacher()->getEmail(); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no subjects found in subjects
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>

</html>