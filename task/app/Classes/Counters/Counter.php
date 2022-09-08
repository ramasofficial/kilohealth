<?php

namespace App\Classes\Counters;

use App\Interfaces\CounterInterface;

/*
 * Abstract class used to implement the factory design pattern.
 * Children classes PriceRangeCounter, VendorCounter, and
 * KeywordCounter implement the polymorphic CounterInterface::count.
 */
abstract class Counter implements CounterInterface {
    protected array $values;

    function __construct(array $values) {
        $this->values = $values;
    }
}
