<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_DRAFT = 'Draft';
    public const STATUS_SENT = 'Sent';

    public function recipients()
    {
        return $this->hasMany(SmsRecipient::class);
    }
}
