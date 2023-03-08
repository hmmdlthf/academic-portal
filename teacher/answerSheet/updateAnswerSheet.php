<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/answerSheet/AnswerSheet.php';
require_once $ROOT . '/app/answerSheet/AnswerSheetService.php';

session_start();
$answerSheetService = new AnswerSheetService();
$answerSheet = $answerSheetService->getAnswerSheetById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update AnswerSheet</title>
</head>
<body>
    <form action="updateAnswerSheetProcess.php?id=<?php echo $answerSheet->getId() ?>" method="post">
        <input type="number" name="marks" id="marks" placeholder="Add marks" value="<?php echo $answerSheet->getMarks() ?>">
        <button type="submit">update AnswerSheet</button>
    </form>
</body>
</html>