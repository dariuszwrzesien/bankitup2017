<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManager;
use PayAssistantBundle\Entity\User;

class AuthDoctrineRepository implements AuthRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUserByCredentials(string $username, string $password) : User
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy([
                'email' => $username,
                'password' => $password
            ]);

        return $user ?? new User(User::ANONYMOUS_ID);
    }

    public function getUserByTokenKey(string $sessionToken) : User
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneByAuthTokenKey($sessionToken);

        return $user ?? new User(User::ANONYMOUS_ID);
    }

    public function setTokenToUser(User $user, string $sessionToken) : void
    {
        $user->setAuthTokenKey($sessionToken);

        $this->entityManager->merge($user);
        $this->entityManager->flush();
    }
}
