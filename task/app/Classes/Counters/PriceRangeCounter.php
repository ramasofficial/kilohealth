<?php

namespace App\Classes\Counters;

use App\Classes\OfferCollection;

class PriceRangeCounter extends Counter {

    public function count(OfferCollection $offers): int {

        $count = 0;

        $iterator = $offers->getIterator();
        foreach ($iterator as $offer) {

            $price = $offer->getPrice();

            if ($this->values["price_from"] <= $price && $price <= $this->values["price_to"]) {
                $count++;
            }
        }

        return $count;
    }

}
