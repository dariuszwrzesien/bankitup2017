<?php

namespace AppBundle\Query\Dto;

class PaymentsCollectionDto extends \ArrayIterator implements \JsonSerializable
{
    public function __construct(array $array = [], $flags = 0)
    {
        parent::__construct(array_map(function ($totalReceived) {
            return new PaymentDto($totalReceived);
        }, $array), $flags);
    }

    public function jsonSerialize()
    {
        return iterator_to_array($this);
    }
}
