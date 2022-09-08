<?php

namespace App\Interfaces;

use Illuminate\Http\Client\Response;

/*
 * Interface that enforces a class to get data from a HTTP endpoint
 * and parses the response to return a collection of offers.
 */
interface ReaderInterface {
    public function fetch(string $url): Response;
    public function read(string $input): OfferCollectionInterface;
}
