<?php

namespace AppBundle\Repository;

use PayAssistantBundle\Entity\Definition;
use PayAssistantBundle\Repository\DefinitionRepositoryInterface;
use Doctrine\ORM\EntityManager;

class DefinitionDoctrineRepository implements DefinitionRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Definition $definition) : Definition
    {
        $this->entityManager->persist($definition);
        $this->entityManager->flush();

        return $definition;
    }
}
