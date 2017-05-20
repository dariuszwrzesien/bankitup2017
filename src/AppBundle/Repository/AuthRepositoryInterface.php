<?php

namespace AppBundle\Repository;

use PayAssistantBundle\Entity\User;

interface AuthRepositoryInterface
{
    public function getUserByCredentials(string $username, string $password) : User;
    public function setTokenToUser(User $user, string $sessionToken) : void;
    public function getUserByTokenKey(string $sessionToken) : User;
}
