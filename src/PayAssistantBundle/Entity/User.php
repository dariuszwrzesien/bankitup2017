<?php

namespace PayAssistantBundle\Entity;

class User
{
    const ANONYMOUS_ID = null;

    private $id;
    private $email = '';
    private $password = '';
    private $displayName = '';
    private $authTokenKey = null;

    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    public function isAnonymous()
    {
        return $this->getId() === self::ANONYMOUS_ID;
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;

        return $this;
    }

    public function getDisplayName() : string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName) : self
    {
        $this->displayName = $displayName;
    }

    public function getAuthTokenKey() : ?string
    {
        return $this->authTokenKey;
    }

    public function setAuthTokenKey($authTokenKey) : self
    {
        $this->authTokenKey = $authTokenKey;

        return $this;
    }


}
