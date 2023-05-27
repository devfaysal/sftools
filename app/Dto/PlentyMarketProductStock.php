<?php

namespace App\Dto;

class PlentyMarketProductStock
{
    public $stock;
    public $itemId;
    public $variationId;
    public $storageLocationId;

    public function __construct(array $record)
    {
        $this->stock = $record['quantity'] ?? null;
        $this->itemId = $record['itemId'] ?? null;
        $this->variationId = $record['variationId'] ?? null;
        $this->storageLocationId = $record['storageLocationId'] ?? null;
    }
}
