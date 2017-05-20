<?php

namespace AppBundle\Query\Dto;

class MyUserProfileDto implements \JsonSerializable
{
    public $guid;
    public $name;
    public $description;
    public $email;
    public $iconColor;
    public $hasOutgoingAccount;
    public $hasIncomingAccount;

    public function __construct(array $data)
    {
        $this->guid = isset($data['guid']) ? (string)$data['guid'] : '';
        $this->name = isset($data['profile_name']) ? (string)$data['profile_name'] : '';
        $this->description = isset($data['profile_description']) ? (string)$data['profile_description'] : '';
        $this->email = isset($data['profile_email']) ? (string)$data['profile_email'] : '';
        $this->iconColor = isset($data['profile_icon_color']) ? (string)$data['profile_icon_color'] : '';
        $this->hasOutgoingAccount = isset($data['outgoing_account_id']);
        $this->hasIncomingAccount = isset($data['incoming_account_id']);
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
