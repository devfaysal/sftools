<?php

namespace App\Jobs;

use App\Models\SmsRecipient;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $smsRecipient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SmsRecipient $smsRecipient)
    {
        $this->smsRecipient = $smsRecipient;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SmsService $sms)
    {
        $sms->send(
            $this->smsRecipient->phone,
            $this->smsRecipient->sms->message
        );
        $this->smsRecipient->update(['status' => SmsRecipient::STATUS_SENT]);
    }
}
