<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Classes\JSONReader;
use App\Classes\OfferCollection;
use App\Classes\Offer;

class JSONReaderTest extends TestCase
{

    public function testConstructsTheOfferCollectionFromGivenResponseBodySuccessfully()
    {
        $test_response_body = '
            HTTP/1.0 200 OK
            Cache-Control: no-cache, private
            Content-Type:  application/json
            Date:          Mon, 05 Sep 2022 15:39:31 GMT

            [
                {"offerId":123,"productTitle":"Coffee machine","vendorId":35,"price":390.4},
                {"offerId":124,"productTitle":"Napkins","vendorId":35,"price":15.5}
            ]
        ';

        $reader = new JSONReader(false); // $do_logging == false

        $test_collection = new OfferCollection([
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
            ])
        ], false); // $do_logging == false

        $this->assertEquals($test_collection, $reader->read($test_response_body));
    }

}
