<?php

namespace App\Classes;

use App\Interfaces\OfferInterface;

/*
 * This data type is used to cleanly transfer offer data within the app.
 * It only contains getters, as modifying offer information is not
 * necessary in this app.
 */
class Offer implements OfferInterface {
    private int $id;
    private string $title;
    private int $vendor_id;
    private float $price;

    function __construct ($array) {
        $this->id = $array["offerId"];
        $this->title = $array["productTitle"];
        $this->vendor_id = $array["vendorId"];
        $this->price = $array["price"];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getVendorId(): int {
        return $this->vendor_id;
    }

    public function getPrice(): float {
        return $this->price;
    }

}
