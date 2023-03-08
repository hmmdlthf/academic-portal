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

    public function getPayments()
    {
        return $this->paymentRepository->findPayments();
    }

    public function save($paymentFee, $studentId)
    { 
        $payment = new Payment();
        $payment->setCreatedDate(date("Y-m-d H:i:s"));
        $payment->setPaymentFee($paymentFee);
        $payment->setIsVerified(false);
        $student = new StudentService();
        $payment->setStudent($student->getStudentById($studentId));
        $this->paymentRepository->save($payment);
    }

    public function update($id, $isVerified)
    {
        $payment = $this->getPaymentById($id);
        if ($payment == false) {
            echo ("payment not found");
            return false;
        }
        $payment->setIsVerified($isVerified);
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
}