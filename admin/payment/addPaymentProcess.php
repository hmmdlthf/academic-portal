<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/payment/PaymentService.php';

session_start();

$paymentFee = $_POST['payment_fee'];
if (empty($paymentFee)) {
    die('Please enter payment fee');
}

$studentId = $_POST['studentId'];
if (empty($studentId)) {
    die('Please select parent student');
}


$paymentService = new PaymentService();
$paymentService->save($paymentFee, $studentId);
echo ("successfull added");