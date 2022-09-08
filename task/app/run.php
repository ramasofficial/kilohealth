<?php

/*
 * @author Dominykas Eičinas
 *
 * This script takes one of three possible options (count_by_price_range, count_by_vendor_id,
 * count_by_keyword) and retrieves data from a HTTP endpoint specified by $http_endpoint_url
 * variable. It then counts the offers that fulfill the criteria drawn by command line arguments.
 * Logging is implemented and can be enabled/disabled by setting $do_logging to true or false.
 * echo'ed strings give a good outline of what steps are being taken in the code.
 */

use App\Classes\ConsoleArgumentParser;
use App\Classes\JSONReader;
use App\Classes\Offer;
use App\Classes\Counters\CounterFactory;

// boilerplate to integrate Laravel into the script
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
//------------------------------------------------------------------------


$http_endpoint_url = "localhost:8000/api/offers";
$do_logging = true;

$cmd_parser = new ConsoleArgumentParser();
echo "\nParsing the command line arguments. (" . get_class($cmd_parser) . "::count)\n";
$console_arg_info = $cmd_parser->parse($argv);

if ($console_arg_info->getSuccess()) {

    echo $console_arg_info->getMessage();

    $reader = new JSONReader($do_logging);
    if ($do_logging) {
        echo "Sending GET request to " . $http_endpoint_url . " (" . get_class($reader) . "::fetch)\n";
    }
    $response = $reader->fetch($http_endpoint_url);

    if ($do_logging) {
        echo "Received response with status code " . $response->status() . ".\n";
    }

    if ($response->status() !== 200) {
        exit("Expected response code 200. Exiting script.");
    }

    if ($do_logging) {
        echo "Parsing response JSON payload. (" . get_class($reader) . "::read)\n";
    }
    $collection = $reader->read($response->body());

    $factory = new CounterFactory();
    if ($do_logging) {
        echo "Creating the counter object using factory method. (" . get_class($factory) . "::getCounter)\n";
    }
    $counter = $factory->getCounter($console_arg_info);

    if ($do_logging) {
        echo "Counting offers fulfilling the given criteria. (" . get_class($counter) . "::count)\n";
    }

    $offer_count = $counter->count($collection);

    echo "\nNumber of offers that fullfill the given criteria:\n";
    echo $offer_count;

} else {
    exit($console_arg_info->getMessage());
}
