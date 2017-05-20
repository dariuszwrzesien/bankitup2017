<?php

namespace AppBundle\Query\Dto;

class UserProfileDto implements \JsonSerializable
{
    public $email;
    public $name;

    public function __construct(array $data)
    {
        $this->email = isset($data['email']) ? (string)$data['email'] : '';
        $this->name = isset($data['name']) ? (string)$data['name'] : '';
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
