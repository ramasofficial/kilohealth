<?php

namespace App\Classes\Counters;

use App\Interfaces\CounterInterface;

abstract class Counter implements CounterInterface {
    protected array $values;

    function __construct(array $values) {
        $this->values = $values;
    }
}
