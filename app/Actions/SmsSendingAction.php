<?php

namespace App\Actions;

use App\Jobs\SendSms;
use App\Models\Sms;
use App\Models\SmsRecipient;

class SmsSendingAction
{
    public function __invoke(array $recipients, string $message)
    {
        $sms = Sms::create([
            'user_id' => auth()->user()->id,
            'message' => $message
        ]);
        foreach ($recipients as $recipient) {
            $smsRecipient = $sms->recipients()->create([
                'phone' => $recipient,
                'status' => SmsRecipient::STATUS_PENDING,
            ]);
            SendSms::dispatch($smsRecipient);
        }
        return $sms;
    }
}