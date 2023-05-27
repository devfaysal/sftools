<?php

namespace App\Http\Controllers;

use App\Actions\PlentyMarketSyncStockAction;
use App\Http\Requests\PlentyMarketProductRequest;
use App\Models\PlentyMarketProduct;
use App\Services\PlentyMarketService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PlentyMarketProductController extends Controller
{
    public function index()
    {
        return view('plentymarketproduct.index');
    }

    public function create()
    {
        return view('plentymarketproduct.create');
    }

    public function verify(PlentyMarketProductRequest $request)
    {
        $plentyMarketService = new PlentyMarketService('mu_varient');
        $mu_stock = $plentyMarketService->getStockByVariationId($request->mu_varient);

        $plentyMarketService = new PlentyMarketService('ms_varient');
        $ms_stock = $plentyMarketService->getStockByVariationId($request->ms_varient);

        $plentyMarketService = new PlentyMarketService('on_varient');
        $on_stock = $plentyMarketService->getStockByVariationId($request->on_varient);
        
    }

    public function store(PlentyMarketProductRequest $request)
    {
        $attributes = $request->validated();
        auth()->user()->plentyMarketProducts()->create($attributes);
        session()->flash('message', 'Product added successfully!!');
        session()->flash('alert-class', 'alert-success');
        return redirect()->route('plentyMarketProducts.index');
    }

    public function edit(PlentyMarketProduct $product)
    {
        return view('plentymarketproduct.edit', [
            'product' => $product
        ]);
    }

    public function update(PlentyMarketProductRequest $request, PlentyMarketProduct $product)
    {
        $attributes = $request->validated();
        $product->update($attributes);
        session()->flash('message', 'Product updated successfully!!');
        session()->flash('alert-class', 'alert-success');
        return redirect()->route('plentyMarketProducts.index');
    }

    public function delete(PlentyMarketProduct $product)
    {
        $product->delete();
        session()->flash('message', 'Product deleted successfully!!');
        session()->flash('alert-class', 'alert-success');
        return redirect()->route('plentyMarketProducts.index');
    }

    public function checkStock(PlentyMarketProduct $product, PlentyMarketSyncStockAction $plentyMarketSyncStockAction)
    {
        $statuses = $plentyMarketSyncStockAction($product);
        
        return view('plentymarketproduct.checkStock',[
            'mu_status' => $statuses['mu_status'],
            'ms_status' => $statuses['ms_status'],
            'on_status' => $statuses['on_status']
        ]);
    }

    public function datatable()
    {
        $products = PlentyMarketProduct::where('user_id', auth()->user()->id);
        return DataTables::of($products)
            ->editColumn('status', function($product){
                if($product->status == 'Active'){
                    return '<span class="badge badge-success">' . $product->status . '</span>';
                }
                return '<span class="badge badge-warning">' . $product->status . '</span>';
            })
            ->addColumn('action', function ($product) {
                $string = '';
                $string .= ' <a class="btn btn-sm btn-oval btn-warning" href="' . route('plentyMarketProducts.edit', $product) . '">Edit</a>';
                if($product->status == 'Active'){
                    $string .= ' <a class="btn btn-sm btn-oval btn-primary" href="' . route('plentyMarketProducts.checkStock', $product) . '">Check Stock</a>';
                }
                return $string;
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }
}
