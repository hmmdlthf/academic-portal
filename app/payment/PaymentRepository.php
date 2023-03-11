<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/payment/Payment.php";
require_once $ROOT . "/app/student/StudentService.php";
require_once $ROOT . "/app/utils/boolean.php";

class PaymentRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $payment = new Payment();
        $payment->setId($array['id']);
        $payment->setCreatedDate($array['created_date']);
        $payment->setPaymentFee($array['payment_fee']);
        $payment->setStatusCode($array['status_code']);
        $payment->setOrderId($array['order_id']);
        if (!is_null($array['payment_id'])) {
            $payment->setPaymentId($array['payment_id']);
        }
        $student = new StudentService();
        $payment->setStudent($student->getStudentById($array['student_id']));
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

    public function findPaymentByOrderId(string $orderId)
    {
        $query = "SELECT * FROM `payment` WHERE `order_id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$orderId]);
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
        $query = "INSERT INTO `payment` (`created_date`, `payment_fee`, `status_code`, `order_id`, `student_id`) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$payment->getCreatedDate(), $payment->getPaymentFee(), $payment->getStatusCode(), $payment->getOrderId(), $payment->getStudent()->getId()]);
        return true;
    }

    public function update(Payment $payment)
    {
        $query = "UPDATE `payment` SET `status_code`=?, `payment_id`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$payment->getStatusCode(), $payment->getPaymentId(), $payment->getId()]);
        return true;
    }

    public function delete(Payment $payment)
    {
        $query = "DELETE FROM `payment` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$payment->getId()]);
    }

    public function count()
    {
        $query = "SELECT COUNT(*) FROM `payment`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetch();
        return $resultSet['COUNT(*)'];
    }
}