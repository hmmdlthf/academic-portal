<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/payment/Payment.php';
require_once $ROOT . '/app/payment/PaymentService.php';
require_once $ROOT . '/app/student/Student.php';

session_start();

$paymentService = new PaymentService();
$payments = $paymentService->getPayments();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
</head>

<body>
<button onclick="document.location = '/admin/payment/addPayment.php'">Add Payment</button>
    <div class="payments">

        <?php foreach ($payments as $payment) { ?>
            <div class="payment">
                <div class="id"><?php echo $payment->getId(); ?></div>
                <div class="name"><?php echo $payment->getName(); ?></div>
                <div class="student"><?php echo $payment->getStudent()->getName(); ?></div>
                <button onclick="document.location = '/admin/payment/deletePayment.php?id=<?php echo $payment->getId(); ?>'">Delete</button>
                <button onclick="document.location = '/admin/payment/updatePayment.php?id=<?php echo $payment->getId(); ?>'">update</button>
            </div>
            <br><br>
        <?php } ?>


    </div>
</body>

</html>