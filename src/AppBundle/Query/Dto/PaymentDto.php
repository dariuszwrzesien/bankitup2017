<?php

namespace AppBundle\Query\Dto;

class PaymentDto implements \JsonSerializable
{
    public $id;
    public $added;
    public $name;
    public $amount;
    public $currency;
    public $status;

    public function __construct(array $data)
    {
        $this->id = isset($data['id']) ? (int)$data['id'] : null;
        $this->added = isset($data['added']) ? (new \DateTime($data['added']))->format('Y-m-d H:i:s') : null;
        $this->name = isset($data['name']) ? (string)$data['name'] : '';
        $this->amount = isset($data['amount']) ? (int)$data['amount'] : 0;
        $this->currency = isset($data['currency']) ? (string)$data['currency'] : '';
        $this->status = isset($data['status']) ? (string)$data['status'] : '';
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
