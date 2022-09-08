<?php

namespace App\Interfaces;

/*
 * Draws a contract for the collection object containing the
 * offers.
 */
interface OfferCollectionInterface {
    public function getAtIndex(int $index): OfferInterface;
    public function getIterator(): \Iterator;
}
