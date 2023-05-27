<?php

namespace App\Filament\Resources\SmsResource\Pages;

use App\Filament\Resources\SmsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSms extends EditRecord
{
    protected static string $resource = SmsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
