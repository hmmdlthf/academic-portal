<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Officer</title>
</head>
<body>
    <form action="addOfficerProcess.php" method="post">
        <input type="email" name="email" placeholder="Email" id="email">
        <button type="submit">Add Officer</button>
    </form>
</body>
</html>