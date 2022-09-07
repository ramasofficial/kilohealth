<?php

namespace App\Interfaces;

interface OfferInterface {
    public function getId(): int;
    public function getTitle(): string;
    public function getVendorId(): int;
    public function getPrice(): float;
}
