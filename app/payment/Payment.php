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

    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    public function setPaymentFee(float $paymentFee)
    {
        $this->paymentFee = $paymentFee;
    }

    public function makeVerified()
    {
        $this->isVerified = true;
    }

    public function getPaymentById(int $paymentId)
    {
        $query = "SELECT * FROM `payment` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$paymentId]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }

    public function getPaymentsByStudent(int $studentId)
    {
        $query = "SELECT * FROM `payment` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$studentId]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
        } else {
            return false;
        }
    }
    
}