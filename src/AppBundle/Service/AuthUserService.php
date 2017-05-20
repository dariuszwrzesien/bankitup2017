<?php

namespace AppBundle\Service;

use PayAssistantBundle\Entity\User;

class AuthUserService
{
    /**
     * @var User
     */
    private $user;

    public function getUserId() : ?int
    {
        return $this->user->getId();
    }

    public function setUser(User $user) : self
    {
        $this->user = $user;

        return $this;
    }

    public function isAuthenticated() : bool
    {
        return $this->getUserId() !== User::ANONYMOUS_ID;
    }
}
