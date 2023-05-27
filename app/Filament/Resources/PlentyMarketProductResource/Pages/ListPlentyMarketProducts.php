<?php

namespace App\Filament\Resources\PlentyMarketProductResource\Pages;

use App\Filament\Resources\PlentyMarketProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlentyMarketProducts extends ListRecords
{
    protected static string $resource = PlentyMarketProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
