<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/app/payment/Payment.php';
require_once $ROOT . '/app/payment/PaymentService.php';

session_start();

$paymentService = new PaymentService();
$paymentService->delete($_GET['id']);
echo ("delete Successfull");

?>