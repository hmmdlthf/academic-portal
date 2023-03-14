<?php

use function PHPSTORM_META\type;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/grade/Grade.php";

class GradeRepository extends Db
{
    public function addDetailsToModel(array $array)
    {
        $grade = new Grade();
        $grade->setId($array['id']);
        $grade->setName($array['name']);
        $grade->setOrder($array['order']);
        return $grade;
    }

    public function findGradeById(int $id)
    {
        $query = "SELECT * FROM `grade` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findGradeByName(string $name)
    {
        $query = "SELECT * FROM `grade` WHERE `name`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$name]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            return $this->addDetailsToModel($resultSet);
        } else {
            return false;
        }
    }

    public function findGrades()
    {
        $query = "SELECT * FROM `grade`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetchAll();
        $grades = [];

        if ($resultSet > 0) {
            foreach($resultSet as $gradeArray) {
                $grade = $this->addDetailsToModel($gradeArray);
                $grades[] = $grade;
            }
            return $grades;
        } else {
            false;
        }
        return $resultSet;
    }

    public function save(Grade $grade)
    {
        $query = "INSERT INTO `grade` (`name`, `order`) VALUES (?, ?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$grade->getName(), $grade->getOrder()]);
        return true;
    }

    public function update(Grade $grade)
    {
        $query = "UPDATE `grade` SET `name`=?, `order`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$grade->getName(), $grade->getOrder(), $grade->getId()]);
        return true;
    }

    public function delete(Grade $grade)
    {
        $query = "DELETE FROM `grade` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$grade->getId()]);
    }

    public function count()
    {
        $query = "SELECT COUNT(*) FROM `grade`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetch();
        return $resultSet['COUNT(*)'];
    }

    public function findLastGradeOrder()
    {
        $query = "SELECT MAX(`order`) FROM `grade`";
        $statement = $this->connect()->prepare($query);
        $statement->execute([]);
        $resultSet = $statement->fetch();
        return $resultSet;
    }

    public function findAllGradesBellow(Grade $currentGrade)
    {
        $query = "SELECT * FROM `grade` WHERE `order` BETWEEN ? AND ? ORDER BY `order` DESC";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$currentGrade->getOrder(), 0]);
        $resultSet = $statement->fetch();
        $grades = [];

        if ($resultSet > 0) {
            foreach($resultSet as $gradeArray) {
                $grade = $this->addDetailsToModel($gradeArray);
                $grades[] = $grade;
            }
            return $grades;
        } else {
            false;
        }
        return $resultSet;
    }
}