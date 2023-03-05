<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class Payment extends Db
{
    private $id;
    private $createdDate;
    private $paymentFee;
    private $isVerified;
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

    public function getIsVerified()
    {
        return $this->isVerified;
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

    public function setIsVerified(bool $isVerified)
    {
        $this->isVerified = $isVerified;
    }

    public function setStudent(Student $student)
    {
        $this->student = $student;
    }

    public function makeVerified()
    {
        $this->isVerified = true;
    }
    
}