<?php

namespace PayAssistantBundle\Entity;

class Action
{
    const STATUS_TODO = 'todo';
    const STATUS_PAID = 'paid';

    private $id;
    private $definitionId;
    private $value;
    private $status = self::STATUS_TODO;

    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDefinitionId() : int
    {
        return $this->definitionId;
    }

    public function setDefinitionId($definitionId) : Action
    {
        $this->definitionId = $definitionId;

        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value) : Action
    {
        $this->value = $value;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status) : Action
    {
        if (! in_array(status, $this->getAvailableStatues())) {
            throw new \InvalidArgumentException();
        }

        $this->status = $status;

        return $this;
    }

    public function getAvailableStatues()
    {
        return [
            self::STATUS_TODO, self::STATUS_PAID
        ];
    }
}
