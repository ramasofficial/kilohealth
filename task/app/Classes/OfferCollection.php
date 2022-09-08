<?php

namespace App\Classes;

use Illuminate\Support\Collection;
use App\Interfaces\OfferCollectionInterface;
use App\Interfaces\OfferInterface;

/*
 * I extended the Laravel Collection as it is sufficient for this task.
 * Interface implementation uses existing Collection methods.
 * Logging can be enabled inside the constructor.
*/
class OfferCollection extends Collection implements OfferCollectionInterface {

    function __construct($array, $do_logging) {
        parent::__construct($array);

        if (count($array) == $this->count() && $do_logging) {
            echo "Successfully added " . $this->count() . " offers.\n";
        }
    }

    public function getAtIndex(int $index): OfferInterface {
        return parent::get($index);
    }

    public function getIterator(): \Iterator {
        return parent::getIterator();
    }
}
