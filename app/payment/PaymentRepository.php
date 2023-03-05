<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class PaymentRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $payment = new Payment();
        $payment->setId($array['id']);
        $payment->setCreatedDate($array['created_date']);
        $payment->setPaymentFee($array['payment_fee']);
        $payment->setIsVerified($array['is_verified']);
        $student = new StudentService();
        $payment->setStudent($student->getUserById($array['student_id']));
        return $payment;
    }

    public function findPaymentById(int $id)
    {
        $query = "SELECT * FROM `payment` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findPayments()
    {
        $query = "SELECT * FROM `payment`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $payments = [];

        if ($resultSet > 0) {
            foreach($resultSet as $stateArray) {
                $payment = $this->addDetailsToModel($stateArray);
                $payments[] = $payment;
            }
            return $payments;
        } else {
            return false;
        }
    }

    public function save(Payment $payment)
    {
        $query = "INSERT INTO `payment` (`created_date`, `payment_fee`, `is_verified`, `student_id`) VALUES (?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$payment->getCreatedDate(), $payment->getPaymentFee(), $payment->getStudent()->getId()]);
        return true;
    }

    public function update(Payment $payment)
    {
        $query = "UPDATE `payment` SET `is_verified`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$payment->getIsVerified(), $payment->getId()]);
        return true;
    }

    public function delete(Payment $payment)
    {
        $query = "DELETE FROM `payment` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$payment->getId()]);
    }
}