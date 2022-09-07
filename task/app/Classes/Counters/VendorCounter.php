<?php

namespace App\Classes\Counters;

use App\Classes\OfferCollection;

class VendorCounter extends Counter {

    public function count(OfferCollection $offers): int {
        $count = 0;

        $iterator = $offers->getIterator();
        foreach ($iterator as $offer) {
            if ($offer->getVendorId() === $this->values["vendor_id"]) {
                $count++;
            }
        }

        return $count;
    }

}
