<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/student/StudentService.php';

$jwtService = jwt_start(['admin_role']);

$students = (new StudentService())->getStudents();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Student</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
            <?php if (count($students) > 0) { ?>
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
                                <select name="officer" id="officer">
                                    <option value="">officer1</option>
                                    <option value="">officer2</option>
                                    <option value="">officer3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form__group">
                            <div class="form__control">
                                <select name="city" id="city">
                                    <option value="">city1</option>
                                    <option value="">city2</option>
                                    <option value="">city3</option>
                                </select>
                            </div>
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>City</th>
                                    <th>Grade</th>
                                    <th>Officer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student) { ?>
                                    <tr>
                                        <td><?php echo $student->getId(); ?></td>
                                        <td><?php echo $student->getFname(); ?></td>
                                        <td><?php echo $student->getLname(); ?></td>
                                        <td><?php echo $student->getEmail(); ?></td>
                                        <td><?php echo $student->getUsername(); ?></td>
                                        <td><?php echo $student->getStatus(); ?></td>
                                        <td><?php echo $student->getGrade()->getName(); ?></td>
                                        <td><?php echo $student->getOfficer()->getEmail(); ?></td>
                                        <?php if (is_string($student->getCity())) { ?>
                                            <td><?php echo $student->getCity()->getName(); ?></td>
                                        <?php } else { ?>
                                            <th>no city</th>
                                        <?php } ?>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no students registered
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>

</html>