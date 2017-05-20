<?php

namespace AppBundle\Query\Dto;

class UserTotalGivenCollectionDto extends \ArrayIterator implements \JsonSerializable
{
    public function __construct(array $array = [], $flags = 0)
    {
        parent::__construct(array_map(function ($totalSent) {
            return new TotalTipsGivenByUserDto($totalSent);
        }, $array), $flags);
    }

    public function jsonSerialize()
    {
        return iterator_to_array($this);
    }
}
