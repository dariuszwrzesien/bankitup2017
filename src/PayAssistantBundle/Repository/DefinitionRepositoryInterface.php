<?php

namespace PayAssistantBundle\Repository;

use PayAssistantBundle\Entity\Definition;

interface DefinitionRepositoryInterface
{
    public function add(Definition $definition) : Definition;
}
