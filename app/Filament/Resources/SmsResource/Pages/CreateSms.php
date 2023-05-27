<?php

namespace App\Filament\Resources\SmsResource\Pages;

use App\Filament\Resources\SmsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use App\Actions\SmsSendingAction;

class CreateSms extends CreateRecord
{
    protected static string $resource = SmsResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $recipients = explode(PHP_EOL, $data['recipients']);
        $smsSendingAction = new SmsSendingAction();
        $sms = $smsSendingAction(
            $recipients,
            $data['message']
        );
        return $sms;
        // dd($sms);
        return static::getModel()::create($data);
    }
}
