<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/payment/PaymentService.php';
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

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
header('Location: /admin/payment/payment.php?link=payment');