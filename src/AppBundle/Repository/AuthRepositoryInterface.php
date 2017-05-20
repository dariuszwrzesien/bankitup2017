<?php

namespace AppBundle\Repository;

use PayAssistantBundle\Entity\User;

interface AuthRepositoryInterface
{
    public function getUserByCredentials(string $username, string $password) : User;
    public function getUserBySessionToken(string $sessionToken) : User;
    public function assignTokenToUser(User $user, string $sessionToken) : void;
}
