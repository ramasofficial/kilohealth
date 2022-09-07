<?php

namespace App\Interfaces;

use Illuminate\Http\Client\Response;

interface ReaderInterface {
    public function read(string $input): OfferCollectionInterface;
}
