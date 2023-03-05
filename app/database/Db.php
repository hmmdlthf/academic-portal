<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

class Db
{
    public function connect()
    {
//        $servername = getenv('DB_HOST');
//        $username = getenv('DB_USERNAME');
//        $password = getenv('DB_PASSWORD');
//        $dbname = getenv('DB_DATABASE');
//        $port = getenv('DB_PORT');

        $servername = 'localhost';
        $username = 'root';
        $password = 'cs50root';
        $dbname = 'student_management_database2';
        $port = '3306';

        // $servername = 'sql947.main-hosting.eu';
        // $username = 'u793985497_meAftersite';
        // $password = 'MeAftersiteDatabaseUser123@';
        // $dbname = 'u793985497_meAftersite';
        // $port = '3306';

        try {
            $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $th) {
            echo "Connection Failed " . $th->getMessage() . "<br>";
        }
    }
}
