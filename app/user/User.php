<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class User extends Db
{
    private $id;
    private $fname;
    private $lname;
    private $email;
    private $username;
    private $password;
    private $unique_id;
    private $no_attempts;
    private $created_date;
    private $last_login;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFname(): string
    {
        return $this->fname;
    }

    public function getLname(): string
    {
        return $this->lname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {  
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUniqueId(): int
    {
        return $this->unique_id;
    }

    public function getNoAttempts(): int
    {
        return $this->no_attempts;
    }

    public function getCreatedDate(): string
    {
        return $this->created_date;
    }

    public function getLastLogin(): string
    {
        return $this->last_login;
    }

    public function setFname(string $fname)
    {
        $this->fname = $fname;
    }

    public function setLname(string $lname)
    {
        $this->lname = $lname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setPassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setNoAttempts(int $no_attempts)
    {
        $this->no_attempts = $no_attempts;
    }
}