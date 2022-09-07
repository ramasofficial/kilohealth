<?php

namespace App\Classes\Counters;

use App\Classes\OfferCollection;

class KeywordCounter extends Counter {

    public function count(OfferCollection $offers): int {
        $count = 0;

        $iterator = $offers->getIterator();
        foreach($iterator as $offer) {

            $title_lowercase = strtolower($offer->getTitle());
            $keyword_lowercase = strtolower($this->values["keyword"]);

            if (strpos($title_lowercase, $keyword_lowercase) !== false) {
                $count++;
            }
        }

        return $count;
    }

}
