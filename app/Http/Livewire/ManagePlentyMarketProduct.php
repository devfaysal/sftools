<?php

namespace App\Http\Livewire;

use App\Models\PlentyMarketProduct;
use App\Services\PlentyMarketService;
use Livewire\Component;

class ManagePlentyMarketProduct extends Component
{
    public PlentyMarketProduct $product;
    public $update = false;
    public $disabled = 'disabled';
    public $muStock;
    public $muName;
    public $msName;
    public $onName;

    public $rules = [
        'product.user_id' => 'required',
        'product.product_name' => 'required',
        'product.mu_varient' => 'required',
        'product.ms_varient' => 'required',
        'product.on_varient' => 'required',
        'product.stock' => 'required',
        'product.minimum_stock' => 'required',
        'product.status' => 'required',
    ];

    public function mount(PlentyMarketProduct $product)
    {
        $this->product = $product;
        if($product->id){
            $this->update = true;
        }else{
            $this->product->user_id = auth()->id();
            $this->product->status = PlentyMarketProduct::STATUS_ACTIVE;
        }
    }

    public function render()
    {
        return view('livewire.manage-plenty-market-product');
    }

    public function updatedProductMuVarient($value)
    {
        if($value){
            $muSite = new PlentyMarketService('mu_varient');
            $muStock = $muSite->getStockByVariationId($value);
            if($muStock){
                $this->muStock = $muStock->stock;
                $this->product->stock = $muStock->stock;
                $this->product->product_name = $muSite->getProductNameByItemId($muStock->itemId);
                $this->muName = $this->product->product_name;
            }else{
                $this->addError('mu_varient', 'The '.__('MU-Varient').' is invalid.');
            }
        }
        $this->checkDisabled();
    }
    public function updatedProductMsVarient($value)
    {
        if($value){
            $msSite = new PlentyMarketService('ms_varient');
            $msStock = $msSite->getStockByVariationId($value);
            if($msStock){
                $this->msName = $msSite->getProductNameByItemId($msStock->itemId);
            }else{
                $this->addError('ms_varient', 'The ' . __('MS-Varient') . ' is invalid.');
            }
        }
        $this->checkDisabled();
    }
    public function updatedProductOnVarient($value)
    {
        if($value){
            $onSite = new PlentyMarketService('on_varient');
            $onStock = $onSite->getStockByVariationId($value);
            if($onStock){
                $this->onName = $onSite->getProductNameByItemId($onStock->itemId);
            }else{
                $this->addError('on_varient', 'The ' . __('ON-Varient') . ' is invalid.');
            }
        }
        $this->checkDisabled();
    }

    public function checkDisabled()
    {
        $this->disabled = 'disabled';
        if($this->muName && $this->msName && $this->onName){
            $this->disabled = '';
        }
    }

    public function saveProduct()
    {
        $this->validate();
        $this->product->save();
        //Update other 2 site stock
        $msSite = new PlentyMarketService('ms_varient');
        $onSite = new PlentyMarketService('on_varient');
        $ms_status = $msSite->updateStockByVariationId($this->product->ms_varient, $this->muStock);
        $on_status = $onSite->updateStockByVariationId($this->product->on_varient, $this->muStock);
        if(200 == $ms_status && 200 == $ms_status){
            session()->flash('message', 'Product added successfully!!');
            session()->flash('alert-class', 'alert-success');
        }else{
            session()->flash('message', 'Product added, some site stock did not updated!!');
            session()->flash('alert-class', 'alert-warning');
        }
        return redirect()->route('plentyMarketProducts.index');
    }

    public function updateProduct()
    {
        $this->validate();
        $this->product->save();
        session()->flash('message', 'Product updated successfully!!');
        session()->flash('alert-class', 'alert-success');
        return redirect()->route('plentyMarketProducts.index');
    }
}
