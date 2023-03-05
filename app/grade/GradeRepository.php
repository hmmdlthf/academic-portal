<?php

use function PHPSTORM_META\type;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";
require_once $ROOT . "/app/grade/Grade.php";

class GradeRepository extends Db
{
    public function findGradeById(int $id)
    {
        $query = "SELECT * FROM `grade` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $resultSet = $statement->fetch();

        if ($resultSet > 0) {
            $grade = new Grade();
            $grade->setId($id);
            $grade->setName($resultSet['name']);
            return $grade;
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
            $grade = new Grade();
            $grade->setId($resultSet['id']);
            $grade->setName($resultSet['name']);
            return $grade;
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

        // echo "<br><br>";
        // foreach($resultSet as $item) {
        //     echo $item['id'];
        //     echo type($item['id']);
        //     echo "<br>";
        // }
        // echo "<br><br>";

        if ($resultSet > 0) {
            foreach($resultSet as $gradeArray) {
                $grade = new Grade();
                $grade->setId($gradeArray['id']);
                $grade->setName($gradeArray['name']);
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
        $query = "INSERT INTO `grade` (`name`) VALUES (?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$grade->getName()]);
        return true;
    }

    public function update(Grade $grade)
    {
        $query = "UPDATE `grade` SET `name`=? WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$grade->getName(), $grade->getId()]);
        return true;
    }

    public function delete(Grade $grade)
    {
        $query = "DELETE FROM `grade` WHERE `id`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$grade->getId()]);
    }
}