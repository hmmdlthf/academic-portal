<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
</head>
<body>
    <form action="addAdminProcess.php" method="post">
        <input type="email" name="email" placeholder="Email" id="email">
        <button type="submit">Add Admin</button>
    </form>
</body>
</html>