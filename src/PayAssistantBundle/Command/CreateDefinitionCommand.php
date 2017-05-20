<?php

namespace PayAssistantBundle\Command;

use CqrsBundle\Commanding\CommandInterface;

class CreateDefinitionCommand implements CommandInterface
{
    private $name;

    private $transferIban;

    private $transferTitle;

    public function __construct(string $name, string $transferIban, string $transferTitle)
    {
        $this->name = $name;
        $this->transferIban = $transferIban;
        $this->transferTitle = $transferTitle;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function transferIBan(): string
    {
        return $this->transferIban;
    }

    public function transferTitle(): string
    {
        return $this->transferTitle;
    }
}
