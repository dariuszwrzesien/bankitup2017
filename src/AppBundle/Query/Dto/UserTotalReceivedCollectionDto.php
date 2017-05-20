<?php

namespace AppBundle\Query\Dto;

class UserTotalReceivedCollectionDto extends \ArrayIterator implements \JsonSerializable
{
    public function __construct(array $array = [], $flags = 0)
    {
        parent::__construct(array_map(function ($totalReceived) {
            return new TotalTipsReceivedByUserDto($totalReceived);
        }, $array), $flags);
    }

    public function jsonSerialize()
    {
        return iterator_to_array($this);
    }
}
