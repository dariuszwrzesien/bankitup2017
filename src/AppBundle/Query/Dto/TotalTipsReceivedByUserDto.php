<?php

namespace AppBundle\Query\Dto;

class TotalTipsReceivedByUserDto implements \JsonSerializable
{
    public $totalAmount;
    public $numberOfReceived;
    public $date;

    public function __construct(array $data)
    {
        $this->totalAmount = isset($data['total']) ? (int)$data['total'] : 0;
        $this->numberOfReceived = isset($data['received']) ? (int)$data['received'] : 0;
        $this->date = isset($data['date']) ? new \DateTime($data['date']) : null;
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
