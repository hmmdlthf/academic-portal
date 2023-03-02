<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class PaymentRepository extends Db
{
    public function findPaymentById(int $id)
    {
        $query = "SELECT * FROM `payment` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $resultSet;
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
        return $resultSet;
    }

    public function findPaymentsByStudent(int $studentId)
    {
        $isStudent = true; // TODO

        if ($isStudent == true) {
            $query = "SELECT * FROM `payment` WHERE `studentId`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$studentId]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        } else {
            return false;
        }
        

    }
}