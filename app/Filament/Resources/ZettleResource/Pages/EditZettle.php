<?php

namespace App\Filament\Resources\ZettleResource\Pages;

use App\Filament\Resources\ZettleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZettle extends EditRecord
{
    protected static string $resource = ZettleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
