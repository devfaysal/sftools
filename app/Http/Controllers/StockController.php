<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function create()
    {
        return view('stockmanagement.create');
    }
}
