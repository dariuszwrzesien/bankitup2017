<?php

namespace PayAssistantBundle\Event;

use CqrsBundle\Eventing\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class GiveTipEvent extends Event implements EventInterface
{
    private $id;

    private $senderId;

    private $recipientId;

    private $amount;

    private $when;

    private $message;

    public function __construct(int $tipId, int $senderId, int $recipientId, int $amount, string $message, \DateTime $when)
    {
        $this->id = $tipId;
        $this->senderId = $senderId;
        $this->recipientId = $recipientId;
        $this->amount = $amount;
        $this->when = $when;
        $this->message = $message;
    }

    public function __sleep()
    {
        return ['id', 'senderId', 'recipientId', 'amount', 'when'];
    }

    public function id(): int
    {
        return $this->id;
    }

    public function senderId(): int
    {
        return $this->senderId;
    }

    public function recipientId(): int
    {
        return $this->recipientId;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function when(): \DateTime
    {
        return $this->when;
    }

    public function message(): string
    {
        return $this->message;
    }
}
