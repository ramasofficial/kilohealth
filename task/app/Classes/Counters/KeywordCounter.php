<?php

namespace App\Classes\Counters;

use App\Classes\OfferCollection;

class KeywordCounter extends Counter {

    /*
     * This method counts the offers whose title contains a
     * specific keyword given along with the console arguments.
     * The strings are compared after converting them to lowercase.
     */
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
