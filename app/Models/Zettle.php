<?php

namespace App\Models;

use App\Services\ZettleService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Zettle extends Model
{
    use HasFactory, Sushi;

    public function getRows()
    {
        $start_date = request()->has('start_date') ? request()->start_date : null;
        $end_date = request()->has('end_date') ? request()->end_date : null;
        $zettle = new ZettleService();
        $transactions = $zettle->getTransactions($start_date, $end_date);

        return $transactions;
    }

}
