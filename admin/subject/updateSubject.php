<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/subject/Subject.php';
require_once $ROOT . '/app/subject/SubjectService.php';

session_start();
$subjectService = new SubjectService();
$subject = $subjectService->getSubjectById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Subject</title>
</head>
<body>
    <form action="updateSubjectProcess.php?id=<?php echo $subject->getId() ?>" method="post">
        <input type="text" name="name" placeholder="Subject Name" id="name" value="<?php echo $subject->getName() ?>">
        <button type="submit">update Subject</button>
    </form>
</body>
</html>