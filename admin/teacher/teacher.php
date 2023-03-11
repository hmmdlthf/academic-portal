<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

$jwtService = jwt_start(['admin_role']);

$teachers = (new TeacherService())->getTeachers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Teacher</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
            <?php if (count($teachers) > 0) { ?>
                    <div class="filters">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($teachers as $teacher) { ?>
                                    <tr>
                                        <td><?php echo $teacher->getId(); ?></td>
                                        <td><?php echo $teacher->getFname(); ?></td>
                                        <td><?php echo $teacher->getLname(); ?></td>
                                        <td><?php echo $teacher->getEmail(); ?></td>
                                        <td><?php echo $teacher->getUsername(); ?></td>
                                        <td><?php echo $teacher->getStatus(); ?></td>
                                        <?php if (is_string($teacher->getCity())) { ?>
                                            <td><?php echo $teacher->getCity()->getName(); ?></td>
                                        <?php } else { ?>
                                            <th>no city</th>
                                        <?php } ?>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no teachers registered
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>

</html>