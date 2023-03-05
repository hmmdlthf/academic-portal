<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/State.php';
require_once $ROOT . '/app/state/StateService.php';

session_start();

$stateService = new StateService();
$states = $stateService->getStates();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add City</title>
</head>
<body>
    <form action="addCityProcess.php" method="post">
        <select name="stateId" id="" placeholder="Select State">
            <?php foreach($states as $state) { ?>
                <option value="<?php echo $state->getId(); ?>"><?php echo $state->getName(); ?></option>
            <?php } ?>
        </select>
        <input type="text" name="name" placeholder="City Name" id="name">
        <button type="submit">Add City</button>
    </form>
</body>
</html>