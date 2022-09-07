<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/offers', function (): string {
    $payload = [
        [
            "offerId" => 123,
            "productTitle" => "Coffee machine",
            "vendorId" => 35,
            "price" => 390.4
        ],
        [
            "offerId" => 124,
            "productTitle" => "Napkins",
            "vendorId" => 35,
            "price" => 15.5
        ],
        [
            "offerId" => 125,
            "productTitle" => "Chair",
            "vendorId" => 84,
            "price" => 230.0
        ],
        [
            "offerId" => 126,
            "productTitle" => "Phone case",
            "vendorId" => 46,
            "price" => 19.95
        ],
        [
            "offerId" => 127,
            "productTitle" => "Fridge",
            "vendorId" => 91,
            "price" => 600
        ],
        [
            "offerId" => 128,
            "productTitle" => "Desk lamp",
            "vendorId" => 91,
            "price" => 35.60
        ],
        [
            "offerId" => 128,
            "productTitle" => "Picture frame",
            "vendorId" => 91,
            "price" => 8.90
        ],
    ];

    return response()
            ->json($payload);
});
