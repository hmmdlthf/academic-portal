<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/payment/Payment.php';
require_once $ROOT . '/app/payment/PaymentService.php';

session_start();
$paymentService = new PaymentService();
$payment = $paymentService->getPaymentById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Update Payment</title>
</head>
<body>
    <form action="updatePaymentProcess.php?id=<?php echo $payment->getId() ?>" method="post">
        <input type="number" name="payment_fee" placeholder="Payment Fee" id="payment_fee" value="<?php echo $payment->getPaymentFee() ?>">
        <button type="submit">update Payment</button>
    </form>
</body>
</html>