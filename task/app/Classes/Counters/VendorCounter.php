<?php

namespace App\Classes\Counters;

use App\Classes\OfferCollection;

class VendorCounter extends Counter {

    /*
     * This method counts the offers from a vendor that is specified
     * by the given vendor ID as a command line argument.
     */
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
