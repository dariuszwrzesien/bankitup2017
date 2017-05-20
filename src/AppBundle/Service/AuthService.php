<?php

namespace AppBundle\Service;

use AppBundle\Repository\AuthRepositoryInterface;

class AuthService
{
    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function authenticate(string $username, string $password, string $sessionToken) : bool
    {
        $user = $this->authRepository->getUserByCredentials($username, $password);

        if ($user->isAnonymous()) {
            return false;
        }

        $this->authRepository->setTokenToUser($user, $sessionToken);

       return true;
    }
}
