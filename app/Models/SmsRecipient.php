<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsRecipient extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public const STATUS_SENT = 'Sent';
    public const STATUS_PENDING = 'Pending';

    public function sms()
    {
        return $this->belongsTo(Sms::class);
    }
}
