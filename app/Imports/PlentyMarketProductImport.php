<?php

namespace App\Imports;

use App\Models\PlentyMarketProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlentyMarketProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PlentyMarketProduct([
            'user_id' => auth()->id(),
            'product_name' => $row['product_name'] ?? 'Name',
            'mu_varient' => $row['mu_varient'],
            'ms_varient' => $row['ms_varient'],
            'on_varient' => $row['on_varient'],
            'minimum_stock' => $row['minimum_stock'] ?? 10,
            'status' => PlentyMarketProduct::STATUS_IMPORTED,
        ]);
    }
}
