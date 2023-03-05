<?php 

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/database/Db.php";

class User extends Db
{
    protected $id;
    protected $fname;
    protected $lname;
    protected $email;
    protected $username;
    protected $password;
    protected $token;
    protected $uniqueId;
    protected $noAttempts;
    protected $createdDate;
    protected $lastLogin;
    protected $isVerified;

    public function __construct()
    {
        $this->noAttempts = 0;
    }

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

    public function getToken()
    {
        return $this->token;
    }

    public function getUniqueId(): int
    {
        return $this->uniqueId;
    }

    public function getNoAttempts(): int
    {
        return $this->noAttempts;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function getLastLogin(): string
    {
        return $this->lastLogin;
    }

    public function getIsVerified()
    {
        return $this->isVerified;
    }

    public function setId(int $id)
    {
        $this->id = $id;
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

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function setUniqueId(string $uniqueId)
    {
        $this->uniqueId = $uniqueId;
    }

    public function setNoAttempts(int $noAttempts)
    {
        $this->noAttempts = $noAttempts;
    }

    public function setCreatedDate(string $createdDate)
    {
        $this->createdDate = $createdDate;
    }

    public function setLastLogin(string $lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    public function setIsVerified(bool $isVerified)
    {
        $this->isVerified = $isVerified;
    }

    public function incrementNoAttempts()
    {
        $this->noAttempts += 1;
    }
}