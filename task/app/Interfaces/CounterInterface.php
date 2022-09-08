<?php

namespace App\Interfaces;

use App\Classes\OfferCollection;

/*
 * This interface draws a contract for the Counter class.
 * CounterInterface::count is a polymorphic method in the
 * classes extending Counter.
 */
interface CounterInterface {
    public function count(OfferCollection $offers): int;
}
