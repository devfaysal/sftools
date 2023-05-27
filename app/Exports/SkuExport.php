<?php

namespace App\Exports;

use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\FromArray;

class SkuExport implements FromArray
{
    public $skus;

    public function __construct($cacheKey)
    {
        $this->skus = Cache::get($cacheKey, []);
    }
    public function array():array
    {
        $data = [];
        foreach($this->skus as $sku){
            $data[][] = $sku;
        }
        return [
            $data
        ];
    }
}
