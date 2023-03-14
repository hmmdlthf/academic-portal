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
                    <button class="btn btn__primary" onclick="document.location = '/admin/student/addStudent.php?link=add%20student'">Add New Student</button>
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
                                    <th>Action</th>
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
                                            <th>no city</th>
                                        <?php } else { ?>
                                            <td><?php echo $student->getCity()->getName(); ?></td>
                                        <?php } ?>
                                        <td>
                                            <div class="actions">
                                                <div class="deleteBtn" onclick="document.location = '/admin/student/deleteStudent.php?id=<?php echo $student->getId(); ?>'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                    </svg>
                                                </div>
                                                <div class="editBtn" onclick="document.location = '/admin/student/updateStudent.php?id=<?php echo $student->getId(); ?>'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </td>
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