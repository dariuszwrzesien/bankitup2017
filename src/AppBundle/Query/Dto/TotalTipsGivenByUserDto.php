<?php

namespace AppBundle\Query\Dto;

class TotalTipsGivenByUserDto implements \JsonSerializable
{
    public $totalAmount;
    public $numberOfGiven;
    public $date;

    public function __construct(array $data)
    {
        $this->totalAmount = isset($data['total']) ? (int)$data['total'] : 0;
        $this->numberOfGiven = isset($data['given']) ? (int)$data['given'] : 0;
        $this->date = isset($data['date']) ? new \DateTime($data['date']) : null;
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
