<?php

namespace App\Filament\Resources\PostingResource\Pages;

use App\Filament\Resources\PostingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostings extends ListRecords
{
    protected static string $resource = PostingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
