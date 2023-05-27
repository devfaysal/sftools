<?php

namespace Modules\SkuGenerator\Http\Livewire;

use Livewire\Component;

class SkuOptions extends Component
{
    public $count = 1;
    public $priceRow;

    public function render()
    {
        return view('skugenerator::livewire.sku-options');
    }

    public function add()
    {
        $this->count++;
    }
    public function remove()
    {
        $this->count--;
    }
}
