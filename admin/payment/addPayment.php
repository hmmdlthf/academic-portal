<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/student/Student.php';
require_once $ROOT . '/app/student/StudentService.php';
require_once $ROOT . '/app/payment/Payment.php';
require_once $ROOT . '/app/payment/PaymentService.php';

session_start();

$studentService = new StudentService();
$students = $studentService->getStudents();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment</title>
</head>
<body>
    <form action="addPaymentProcess.php" method="post">
        <select name="studentId" id="" placeholder="Select Student">
            <?php foreach($students as $student) { ?>
                <option value="<?php echo $student->getId(); ?>"><?php echo $student->getEmail(); ?></option>
            <?php } ?>
        </select>
        <input type="number" name="payment_fee" placeholder="Payment Fee" id="payment_fee">
        <button type="submit">Add Payment</button>
    </form>
</body>
</html>