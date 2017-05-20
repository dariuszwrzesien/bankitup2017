<?php

namespace AppBundle\Query\Dto;

class PaymentToDoDto implements \JsonSerializable
{
    public $id;
    public $added;
    public $name;
    public $amount;
    public $currency;

    public function __construct(array $data)
    {
        $this->id = isset($data['id']) ? (int)$data['id'] : null;
        $this->added = isset($data['added']) ? new \DateTime($added) : null;
        $this->name = isset($data['name']) ? (string)$data['name'] : '';
        $this->amount = isset($data['amount']) ? (int)$data['amount'] : 0;
        $this->currency = isset($data['currency']) ? (string)$data['currency'] : '';
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
