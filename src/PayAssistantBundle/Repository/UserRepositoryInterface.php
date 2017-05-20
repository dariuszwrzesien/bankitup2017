<?php

namespace PayAssistantBundle\Repository;

use PayAssistantBundle\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user) : User;
    public function getById(int $id) : ?User;
    public function getByGuid(string $guid) : ?User;
    public function getByBankUserId(string $bankUserId) : ?User;
}
