<?php

namespace AppBundle\Query\Dto;

class TipGivenDto implements \JsonSerializable
{
    public $date;
    public $amount;
    public $message;
    public $recipientName;
    public $recipientColor;

    public function __construct(array $data)
    {
        $this->date = isset($data['given']) ? new \DateTime($data['given']) : null;
        $this->amount = isset($data['amount']) ? (int)$data['amount'] : null;
        $this->message = isset($data['message']) ? (string)$data['message']: '';
        $this->recipientName = isset($data['recipient_name']) ? (string)$data['recipient_name']: '';
        $this->recipientColor = isset($data['recipient_color']) ? (string)$data['recipient_color']: '';
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
