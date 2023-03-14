<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/payment/Payment.php';
require_once $ROOT . '/app/payment/PaymentService.php';

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
$jwtService = jwt_start(['admin_role']);

$paymentId = $_GET['id'];
$paymentFee = $_POST['payment_fee'];
$paymentFee = $_POST['status_code'];

$paymentService = new PaymentService();
$paymentService->update($paymentId, $status_code, $paymentFee);
echo ("update Successfull");
header('Location: /admin/payment/payment.php?link=payment');

?>