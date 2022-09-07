<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Classes\ConsoleArgumentInfo;
use App\Classes\Counters\CounterFactory;

class CounterFactoryTest extends TestCase
{

    public function testFactoryCreatesPriceRangeCounterAppropriately()
    {
        $console_argument_info = new ConsoleArgumentInfo();
        $console_argument_info->setOption("price");
        $console_argument_info->setValues([
            "price_from" => 10,
            "price_to" => 20
        ]);

        $factory = new CounterFactory();
        $counter = $factory->getCounter($console_argument_info);

        $this->assertEquals("App\Classes\Counters\PriceRangeCounter", get_class($counter));
    }

    public function testFactoryCreatesVendorCounterAppropriately()
    {
        $console_argument_info = new ConsoleArgumentInfo();
        $console_argument_info->setOption("vendor");
        $console_argument_info->setValues([
            "vendor_id" => 10,
        ]);

        $factory = new CounterFactory();
        $counter = $factory->getCounter($console_argument_info);

        $this->assertEquals("App\Classes\Counters\VendorCounter", get_class($counter));
    }

    public function testFactoryCreatesKeywordCounterAppropriately()
    {
        $console_argument_info = new ConsoleArgumentInfo();
        $console_argument_info->setOption("keyword");
        $console_argument_info->setValues([
            "keyword" => 10,
        ]);

        $factory = new CounterFactory();
        $counter = $factory->getCounter($console_argument_info);

        $this->assertEquals("App\Classes\Counters\KeywordCounter", get_class($counter));
    }

}
