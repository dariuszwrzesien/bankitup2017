<?php

namespace PayAssistantBundle\Command;

use CqrsBundle\Commanding\CommandInterface;
use PayAssistantBundle\Command\Bag\BankBag;

class ConnectUserCommand implements CommandInterface
{
    private $bankBag;
    private $tokenKey;

    public function __construct(BankBag $bankBag, string $tokenKey)
    {
        $this->bankBag = $bankBag;
        $this->tokenKey = $tokenKey;
    }

    public function bankBag() : BankBag
    {
        return $this->bankBag;
    }

    public function tokenKey() : string
    {
        return $this->tokenKey;
    }
}
