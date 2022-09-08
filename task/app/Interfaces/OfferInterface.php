<?php

namespace App\Interfaces;

/*
 * Contract for the class Offer, which is used to cleanly
 * transfer and access offer data.
 */
interface OfferInterface {
    public function getId(): int;
    public function getTitle(): string;
    public function getVendorId(): int;
    public function getPrice(): float;
}
