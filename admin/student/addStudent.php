<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/officer/Officer.php';
require_once $ROOT . '/app/officer/OfficerService.php';

session_start();

$officerService = new OfficerService();
$officers = $officerService->getOfficers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
</head>

<body>
    <form action="addStudentProcess.php" method="post">
        <select name="officerId" id="" placeholder="select Officer">
            <?php foreach ($officers as $officer) { ?>
                <option value="<?php echo $officer->getId(); ?>"><?php echo $officer->getEmail(); ?></option>
            <?php } ?>
        </select>
        <input type="email" name="email" placeholder="Email" id="email">
        <button type="submit">Add Student</button>
    </form>
</body>

</html>