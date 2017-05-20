<?php

namespace PayAssistantBundle\Command\Bag;

class BankBag
{
    private $userId;
    private $userName;
    private $email;
    private $tokenAccess;
    private $tokenSecretAccess;

    public function __construct(string $userId, string $userName, string $email, string $tokenAccess, string $tokenSecretAccess)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->email = $email;
        $this->tokenAccess = $tokenAccess;
        $this->tokenSecretAccess = $tokenSecretAccess;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTokenAccess(): string
    {
        return $this->tokenAccess;
    }

    public function getTokenSecretAccess(): string
    {
        return $this->tokenSecretAccess;
    }
}
