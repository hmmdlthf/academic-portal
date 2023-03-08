<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Payment extends Db
{
    private $id;
    private $createdDate;
    private $paymentFee;
    private $statusCode;
    private $orderId;
    private $paymentId;
    private Student $student;

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function getPaymentFee()
    {
        return $this->paymentFee;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getPaymentId()
    {
        return $this->paymentId;
    }

    public function getStudent()
    {
        return $this->student;
    }
    
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setCreatedDate(string $createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function setPaymentFee(float $paymentFee)
    {
        $this->paymentFee = $paymentFee;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function setOrderId(string $orderId)
    {
        $this->orderId = $orderId;
    }

    public function setPaymentId(string $paymentId)
    {
        $this->paymentId = $paymentId;
    }

    public function setStudent(Student $student)
    {
        $this->student = $student;
    }

    public function generateOrderId()
    {
        $data = random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 12 character UUID.
        // $password = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        $orderId = vsprintf('%s%s%s%s', str_split(bin2hex($data), 4));
        echo ("order_id: $orderId <br>");
        return $orderId;
    }
    
}