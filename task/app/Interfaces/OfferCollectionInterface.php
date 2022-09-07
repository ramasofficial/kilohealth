<?php

namespace App\Interfaces;

interface OfferCollectionInterface {
    public function getAtIndex(int $index): OfferInterface;
    public function getIterator(): \Iterator;
}
