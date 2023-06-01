<?php

namespace App\Filament\Resources\ZettleResource\Pages;

use App\Filament\Resources\ZettleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZettles extends ListRecords
{
    protected static string $resource = ZettleResource::class;

    protected function getActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
 
}
