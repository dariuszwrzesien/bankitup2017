<?php

namespace PayAssistantBundle\Event;

use CqrsBundle\Eventing\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class CreateDefinitionEvent extends Event implements EventInterface
{
    private $id;

    private $name;

    private $transferIban;

    private $transferTitle;

    public function __construct(int $definitionId, string $name, string $transferIban, string $transferTitle)
    {
        $this->id = $definitionId;
        $this->name = $name;
        $this->transferIban = $transferIban;
        $this->transferTitle = $transferTitle;
    }

    public function __sleep()
    {
        return ['id', 'name', 'transferIban', 'transferTitle'];
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function transferIban(): string
    {
        return $this->transferIban;
    }

    public function transferTitle(): string
    {
        return $this->transferTitle;
    }
}
