<?php

namespace AppBundle\Repository;

use PayAssistantBundle\Entity\User;
use PayAssistantBundle\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManager;

class UserDoctrineRepository implements UserRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(User $user) : User
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function getById(int $id) : ?User
    {
        return $this->entityManager
            ->getRepository(User::class)
            ->findOneById($id);
    }

    public function getByGuid(string $guid): ?User
    {
        return $this->entityManager
            ->getRepository(User::class)
            ->findOneByGuid($guid);
    }

    public function getByBankUserId(string $bankUserId): ?User
    {
        return $this->entityManager
            ->getRepository(User::class)
            ->findOneByBankUserId($bankUserId);
    }
}
