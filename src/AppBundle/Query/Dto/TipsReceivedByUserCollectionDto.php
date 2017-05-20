<?php

namespace AppBundle\Query\Dto;

class TipsReceivedByUserCollectionDto extends \ArrayIterator implements \JsonSerializable
{
    public function __construct($array = array(), $flags = 0)
    {
        parent::__construct(array_map(function ($tip) {
            return new TipReceivedDto($tip);
        }, $array), $flags);
    }

    public function jsonSerialize()
    {
        return iterator_to_array($this);
    }
}
