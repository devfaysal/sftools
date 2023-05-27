<?php

namespace App\Filament\Resources\PostingResource\Pages;

use App\Filament\Resources\PostingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPosting extends EditRecord
{
    protected static string $resource = PostingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
