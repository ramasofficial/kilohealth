<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Classes\ConsoleArgumentInfo;
use App\Classes\Counters\CounterFactory;
use App\Classes\OfferCollection;
use App\Classes\Offer;

class CounterTest extends TestCase
{

    public function testCountsOffersByPriceRangeCorrectly()
    {
        $console_argument_info = new ConsoleArgumentInfo();
        $console_argument_info->setOption("price");
        $console_argument_info->setValues([
            "price_from" => 200,
            "price_to" => 400
        ]);

        $counter = (new CounterFactory())->getCounter($console_argument_info);
        $collection = $this->createCollection();

        $this->assertEquals(2, $counter->count($collection));
    }

    public function testCountsOffersByVendorCorrectly()
    {
        $console_argument_info = new ConsoleArgumentInfo();
        $console_argument_info->setOption("vendor");
        $console_argument_info->setValues([
            "vendor_id" => 35
        ]);

        $counter = (new CounterFactory())->getCounter($console_argument_info);
        $collection = $this->createCollection();

        $this->assertEquals(2, $counter->count($collection));
    }

    public function testCountsOffersByKeywordCorrectly()
    {
        $console_argument_info = new ConsoleArgumentInfo();
        $console_argument_info->setOption("keyword");
        $console_argument_info->setValues([
            "keyword" => "chair"
        ]);

        $counter = (new CounterFactory())->getCounter($console_argument_info);
        $collection = $this->createCollection();

        $this->assertEquals(1, $counter->count($collection));
    }

    private function createCollection() {
        return new OfferCollection([
            new Offer([
                "offerId" => 123,
                "productTitle" => "Coffee machine",
                "vendorId" => 35,
                "price" => 390.4
            ]),
            new Offer([
                "offerId" => 124,
                "productTitle" => "Napkins",
                "vendorId" => 35,
                "price" => 15.5
            ]),
            new Offer([
                "offerId" => 125,
                "productTitle" => "Chair",
                "vendorId" => 84,
                "price" => 230.0
            ])
        ], false); // $do_logging == false
    }

}
