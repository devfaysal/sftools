<?php

namespace App\Http\Controllers;

use App\Services\ZettleService;
use Illuminate\Http\Request;

class ZettleController extends Controller
{
    public function index(ZettleService $zettle, Request $request)
    {
        $start_date = $request->has('start_date') ? $request->start_date : null;
        $end_date = $request->has('end_date') ? $request->end_date : null;
        $transactions = $zettle->getTransactions($start_date, $end_date);
        dd($transactions);
        return view('zettle.index',[
            'transactions' => $transactions
        ]);
    }
}
