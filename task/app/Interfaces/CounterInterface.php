<?php

namespace App\Interfaces;

use App\Classes\OfferCollection;

interface CounterInterface {
    public function count(OfferCollection $offers): int;
}
