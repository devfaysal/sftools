<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SkuGenerator extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.sku-generator';

    public $options = [];
    public $priceRow;
    public $skus;

    public function mount()
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            // Textarea::make('options')->required(),
            Repeater::make('options')
                ->schema([
                    Textarea::make('option')->required(),
                ])
                ->defaultItems(1),
            Select::make('priceRow')
                ->options(
                    range(1, count($this->options) +1 )
                    )
                ->required()
        ];
    }

    public function submit()
    {
        // dd($this->options);
        $combinations = [[]];
        $data = [];
        foreach ($this->options as $option) {
            // dd($option);
            $data[] = explode(PHP_EOL, $option['option']);
        }

        $length = count($data);
        for ($count = 0; $count < $length; $count++) {
            $tmp = [];
            foreach ($combinations as $v1) {
                foreach ($data[$count] as $v2) {
                    $tmp[] = array_merge($v1, [trim($v2)]);
                }
            }
            $combinations = $tmp;
        }
        $price = null;
        if ($this->priceRow) {
            $priceRow = $this->priceRow - 1;
            $price = array_sum(array_column($combinations, $priceRow));
        }
        $skus = [];
        foreach ($combinations as $combination) {
            $sku1 = [];
            $sku2 = [];
            foreach ($combination as $part) {
                if (Str::contains($part,
                    '#'
                )) {
                    $parts = explode('#', $part);
                    $sku1[] = trim($parts[0]);
                    $sku2[] = trim($parts[1]);
                } else {
                    $sku1[] = $part;
                }
            }
            if (empty($sku2)) {
                $skus[] = implode('-', $sku1);
            } else {
                $skus[] = implode('-', $sku1) . ' | ' . implode(' ', $sku2);
            }
        }

        $cacheKey = Str::uuid();
        Cache::put($cacheKey, $skus, now()->addMinutes(60));
        
        $this->skus = $skus;
        // $this->validate();

        // SAVE THE SETTINGS HERE
    }
}
