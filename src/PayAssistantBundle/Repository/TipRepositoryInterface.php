<?php

namespace PayAssistantBundle\Repository;

use PayAssistantBundle\Entity\Tip;

interface TipRepositoryInterface
{
    public function add(Tip $tip) : Tip;
}
