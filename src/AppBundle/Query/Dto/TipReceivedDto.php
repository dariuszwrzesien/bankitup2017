<?php

namespace AppBundle\Query\Dto;

class TipReceivedDto implements \JsonSerializable
{
    public $date;
    public $amount;
    public $message;

    public function __construct(array $data)
    {
        $this->date = isset($data['given']) ? new \DateTime($data['given']) : null;
        $this->amount = isset($data['amount']) ? (int)$data['amount'] : null;
        $this->message = isset($data['message']) ? (string)$data['message']: '';
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
