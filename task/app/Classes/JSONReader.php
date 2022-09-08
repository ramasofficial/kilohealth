<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Interfaces\ReaderInterface;
use App\Interfaces\OfferCollectionInterface;
use App\Classes\OfferCollection;
use App\Classes\Offer;

/*
 * This class is a communication medium between the given HTTP endpoint and the script.
 * It gathers JSON data from the endpoint and outputs an OfferCollection object.
 */
class JSONReader implements ReaderInterface {
    private bool $do_logging; // set true to enable logging within this class
    private OfferCollection $offers;

    /*
     * Logging can be enabled on construction.
     */
    function __construct(bool $do_logging) {
        $this->do_logging = $do_logging;
    }

    /*
     * This function takes the URL of a HTTP endpoint, sends
     * an empty GET request, and returns the Response object.
     */
    public function fetch(string $url): Response {
        return Http::get($url, []);
    }
    /*
     * Takes the response body (string), takes the headers off it
     * and constructs an OfferCollection object that is returned.
     */
    public function read(string $input): OfferCollectionInterface {

        $json_content = $this->deleteHeadersOffPayload($input);
        $plain_array = json_decode($json_content, true);

        if ($this->do_logging) {
            echo "Converting array entries to Offer objects. (". get_class($this) . "::read)\n";
        }

        $offer_array = array_map(array($this, 'convert'), $plain_array);

        if ($this->do_logging) {
            echo "Constructing a collection of offers. (App\Classes\OfferCollection::__construct)\n";
        }

        $this->offers = new OfferCollection($offer_array, $this->do_logging);

        return $this->offers;
    }

    /*
     * Removes the headers off the response body (string) and returns plain
     * JSON string.
     */
    function deleteHeadersOffPayload(string $body): string {
        if ($this->do_logging) {
            echo "Removing headers off the payload.\n";
        }

        return substr($body, strpos($body, '['), strlen($body));
    }

    /*
     * Used in array_map to convert JSON decoded arrays into Offer objects.
     */
    private function convert($arr): Offer {
        return new Offer($arr);
    }

    /*
     * A getter for the OfferCollection.
     */
    public function getAllOffers() {
        return $this->offers;
    }
}
