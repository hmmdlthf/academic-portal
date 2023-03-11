<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/officer/OfficerService.php';

$jwtService = jwt_start(['admin_role']);

$officers = (new OfficerService())->getOfficers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Officer</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
            <?php if (count($officers) > 0) { ?>
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
                                    <th>City</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($officers as $officer) { ?>
                                    <tr>
                                        <td><?php echo $officer->getId(); ?></td>
                                        <td><?php echo $officer->getFname(); ?></td>
                                        <td><?php echo $officer->getLname(); ?></td>
                                        <td><?php echo $officer->getEmail(); ?></td>
                                        <td><?php echo $officer->getUsername(); ?></td>
                                        <?php if (is_string($officer->getCity())) { ?>
                                            <td><?php echo $officer->getCity()->getName(); ?></td>
                                        <?php } else { ?>
                                            <th>no city</th>
                                        <?php } ?>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no officers registered
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>

</html>