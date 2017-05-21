<?php

namespace AppBundle\Query\Dto;

class PaymentDto implements \JsonSerializable
{
    public $id;
    public $added;
    public $paid;
    public $name;
    public $amount;
    public $currency;
    public $status;
    public $overdeal;

    public function __construct(array $data)
    {
        $this->id = isset($data['id']) ? (int)$data['id'] : null;
        $this->added = isset($data['added']) ? (new \DateTime($data['added']))->format('Y/m/d') : null;
        $this->paid = isset($data['paid']) ? (new \DateTime($data['paid']))->format('Y/m/d') : null;
        $this->name = isset($data['name']) ? (string)$data['name'] : '';
        $this->amount = isset($data['amount']) ? ($data['amount'] / 100) : 0;
        $this->currency = isset($data['currency']) ? (string)$data['currency'] : '';
        $this->status = isset($data['status']) ? (string)$data['status'] : '';
        $this->overdeal = array_key_exists('overdeal', $data) ? $data['overdeal'] : false;
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
