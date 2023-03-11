<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . '/app/payment/Payment.php';
require_once $ROOT . '/app/payment/PaymentRepository.php';
require_once $ROOT . '/app/student/StudentService.php';

class PaymentService
{
    private PaymentRepository $paymentRepository;

    public function __construct()
    {
        $this->paymentRepository = new PaymentRepository;
    }

    public function getPaymentById(int $paymentId)
    {
        return $this->paymentRepository->findPaymentById($paymentId);
    }

    public function getPaymentByOrderId(string $orderId)
    {
        return $this->paymentRepository->findPaymentByOrderId($orderId);
    }

    public function getPayments()
    {
        return $this->paymentRepository->findPayments();
    }

    public function save($paymentFee, $studentId)
    { 
        $payment = new Payment();
        $payment->setCreatedDate(date("Y-m-d H:i:s"));
        $payment->setPaymentFee($paymentFee);
        $payment->setStatusCode(0);
        $orderId = $payment->generateOrderId();
        $payment->setOrderId($orderId);
        $student = new StudentService();
        $payment->setStudent($student->getStudentById($studentId));
        $this->paymentRepository->save($payment);
        return $orderId;
    }

    public function update($id, $statusCode, $paymentId)
    {
        $payment = $this->getPaymentById($id);
        if ($payment == false) {
            echo ("payment not found");
            return false;
        }
        $payment->setStatusCode($statusCode);
        $payment->setPaymentId($paymentId);
        $this->paymentRepository->update($payment);
    }

    public function updateByOrderId($orderId, $statusCode, $paymentId)
    {
        $payment = $this->getPaymentByOrderId($orderId);
        if ($payment == false) {
            echo ("payment not found");
            return false;
        }
        $payment->setStatusCode($statusCode);
        $payment->setPaymentId($paymentId);
        $this->paymentRepository->update($payment);
    }

    public function delete($id)
    {
        $payment = $this->getPaymentById($id);
        if ($payment == false) {
            echo ("payment not found");
            return false;
        }
        $this->paymentRepository->delete($payment);
    }

    public function count()
    {
        return $this->paymentRepository->count();
    }
}