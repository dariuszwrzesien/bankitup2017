<?php

namespace AppBundle\Query\Dto;

class UserProfileDto implements \JsonSerializable
{
    public $name;
    public $description;
    public $iconColor;

    public function __construct(array $data)
    {
        $this->name = isset($data['profile_name']) ? (string)$data['profile_name'] : '';
        $this->description = isset($data['profile_description']) ? (string)$data['profile_description'] : '';
        $this->iconColor = isset($data['profile_icon_color']) ? (string)$data['profile_icon_color'] : '';
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
