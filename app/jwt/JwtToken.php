<?php

use Firebase\JWT\JWT;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';

class JwtToken
{
    private $hasValidCredentials;
    private $algo;
    private $secretKey;
    private $tokenId;
    private $issuedAt;
    private $expire;
    private $expireLength; // length in minutes
    private $serverName;
    private $username;
    private $jwt;
    private $array;

    public function __construct()
    {
        $this->hasValidCredentials = false;
        $this->secretKey = 'be22b52b-95a6-4d29-81ed-8ab54ba1f9db';
        $this->algo = 'HS512';
        $this->tokenId = base64_decode(random_bytes(16));
        $currentTime = new DateTimeImmutable();
        $this->issuedAt = $currentTime->getTimestamp();
        $this->setExpireLength(6);
        $expireLength = $this->getExpireLength();
        $this->expire = $currentTime->modify('+6 minutes')->getTimestamp();
        // try {
        //     $this->expire = $currentTime->modify('+6 minutes')->getTimestamp();
        // } catch(Exception $e) {
        //     die("error: $e");
        // }
        
        $this->serverName = $_SERVER['HTTP_HOST'];
    }

    public function getHasValidCredentials()
    {
        return $this->hasValidCredentials;
    }

    public function getAlgo()
    {
        return $this->algo;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function getTokenId()
    {
        return $this->tokenId;
    }

    public function getIssuedAt()
    {
        return $this->issuedAt;
    }

    public function getExpire()
    {
        return $this->expire;
    }

    public function getExpireLength()
    {
        return $this->expireLength;
    }

    public function getServerName()
    {
        return $this->serverName;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getJwt()
    {
        return $this->jwt;
    }

    public function getArray()
    {
        return $this->array;
    }

    public function setHasValidCredentials(bool $hasValidCredentials)
    {
        $this->hasValidCredentials = $hasValidCredentials;
    }

    public function setSecretKey(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function setTokenId(string $tokenId)
    {
        $this->tokenId = $tokenId;
    }

    public function setIssuedAt(int $issuedAt)
    {
        $this->issuedAt = $issuedAt;
    }

    public function setExpire(int $expire)
    {
        $this->expire = $expire;
    }

    public function setExpireLength(int $expireLength)
    {
        $this->expire = $expireLength;
    }

    public function setServerName(string $serverName)
    {
        $this->serverName = $serverName;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setJwt(string $jwt)
    {
        $this->jwt = $jwt;
    }

    public function setArray(array $array)
    {
        $this->array = $array;
    }


}