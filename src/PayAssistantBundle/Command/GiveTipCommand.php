<?php

namespace PayAssistantBundle\Command;

use CqrsBundle\Commanding\CommandInterface;

class GiveTipCommand implements CommandInterface
{
    private $senderId;

    private $recipientGuid;

    private $amount;

    private $given;

    private $message;

    public function __construct(int $senderId, string $recipientGuid, int $amount, string $message, \DateTime $given)
    {
        $this->senderId = $senderId;
        $this->recipientGuid = $recipientGuid;
        $this->amount = $amount;
        $this->given = $given;
        $this->message = $message;
    }

    public function senderId(): int
    {
        return $this->senderId;
    }

    public function recipientGuid(): string
    {
        return $this->recipientGuid;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function given(): \DateTime
    {
        return $this->given;
    }

    public function message(): string
    {
        return $this->message;
    }
}
