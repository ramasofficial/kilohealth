<?php

namespace App\Classes\Counters;

use App\Classes\OfferCollection;
use App\Classes\ConsoleArgumentInfo;

class CounterFactory {

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
