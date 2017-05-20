<?php

namespace AppBundle\Query\Dto;

class TipsGivenByUserCollectionDto extends \ArrayIterator implements \JsonSerializable
{
    public function __construct($array = array(), $flags = 0)
    {
        parent::__construct(array_map(function ($tip) {
            return new TipGivenDto($tip);
        }, $array), $flags);
    }

    public function jsonSerialize()
    {
        return iterator_to_array($this);
    }
}
