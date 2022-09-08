<?php

namespace App\Classes\Counters;

use App\Classes\OfferCollection;
use App\Classes\ConsoleArgumentInfo;

/*
 * A class used to implement the factory design pattern.
 */
class CounterFactory {

    /*
     * Factory method producing the appropriate Counter based on
     * the option passed in with the console arguments.
     */
    function getCounter(ConsoleArgumentInfo $console_arg_info): Counter {

        $option = $console_arg_info->getOption();
        $values = $console_arg_info->getValues();

        if ($option === "price") {
            return new PriceRangeCounter($values);
        } else if ($option === "vendor") {
            return new VendorCounter($values);
        } else if ($option === "keyword") {
            return new KeywordCounter($values);
        }
    }

}
