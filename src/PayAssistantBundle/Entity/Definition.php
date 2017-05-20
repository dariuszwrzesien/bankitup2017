<?php

namespace PayAssistantBundle\Entity;

class Definition
{
    private $id;
    private $name = '';
    private $transferIban = '';
    private $transferTitle = '';

    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getTransferIban(): string
    {
        return $this->transferIban;
    }

    public function setTransferIban(string $transferIban) : Definition
    {
        $this->transferIban = $transferIban;

        return $this;
    }

    public function getTransferTitle(): string
    {
        return $this->transferTitle;
    }

    public function setTransferTitle(string $transferTitle) : Definition
    {
        $this->transferTitle = $transferTitle;
    }
}
