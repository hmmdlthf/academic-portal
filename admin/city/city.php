
<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/city/CityService.php';

$jwtService = jwt_start(['admin_role']);

$cities = (new CityService())->getCities();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | City</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <?php if (count($cities) > 0) { ?>
                    <div class="filters">
                        <div class="form__group">
                            <div class="form__control">
                                <select name="state" id="state">
                                    <option value="">state1</option>
                                    <option value="">state2</option>
                                    <option value="">state3</option>
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
                                    <th>State</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cities as $city) { ?>
                                    <tr>
                                        <td><?php echo $city->getId(); ?></td>
                                        <td><?php echo $city->getName(); ?></td>
                                        <td><?php echo $city->getState()->getName(); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no cities found 
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>

</html>