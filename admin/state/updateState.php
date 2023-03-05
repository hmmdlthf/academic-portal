<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/state/State.php';
require_once $ROOT . '/app/state/StateService.php';

session_start();
$stateService = new StateService();
$state = $stateService->getStateById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update State</title>
</head>
<body>
    <form action="updateStateProcess.php?id=<?php echo $state->getId() ?>" method="post">
        <input type="text" name="name" placeholder="State Name" id="name" value="<?php echo $state->getName() ?>">
        <button type="submit">update State</button>
    </form>
</body>
</html>