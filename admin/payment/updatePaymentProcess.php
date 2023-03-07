<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/payment/Payment.php';
require_once $ROOT . '/app/payment/PaymentService.php';

session_start();

$paymentId = $_GET['id'];
$paymentFee = $_POST['payment_fee'];

$paymentService = new PaymentService();
$paymentService->update($paymentId, $paymentFee);
echo ("update Successfull");

?>