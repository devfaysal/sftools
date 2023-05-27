<?php

namespace App\Http\Livewire;

use App\Imports\PlentyMarketProductImport as ProductImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class PlentyMarketProdcutImport extends Component
{

    use WithFileUploads;

    public $file;
    public $rules = [
        'file' => 'required|mimetypes:text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
    public function updatedFile()
    {
        $this->validate();
    }

    public function import()
    {
        Excel::import(new ProductImport, $this->file);
        $this->file = '';
        session()->flash('message', 'Products saved in database with inactive status, all products will be validated soon!!');
        session()->flash('alert-class', 'alert-success');
        return redirect()->route('plentyMarketProducts.index');
    }
    
    public function render()
    {
        return view('livewire.plenty-market-prodcut-import');
    }
}
