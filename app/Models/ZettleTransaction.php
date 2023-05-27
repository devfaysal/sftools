<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZettleTransaction extends Model
{
    use HasFactory;

    public const TYPE_PAYMENT = 'CARD_PAYMENT';
    public const TYPE_FEE = 'CARD_PAYMENT_FEE';
    public const TYPE_PAYOUT = 'PAYOUT';

    public function postingText($case)
    {
        switch($case){
            case self::TYPE_PAYMENT:
                return 'ProductName from Zettel';
            case self::TYPE_FEE:
                return 'Zettle Gebühren';
            case self::TYPE_PAYOUT:
                return 'Transit zu Paypal';
            default:
                return null;
        }
    }

    public function postingAccount($case)
    {
        switch ($case) {
            case self::TYPE_PAYMENT:
                return '44000';
            case self::TYPE_FEE:
                return '68550';
            case self::TYPE_PAYOUT:
                return '14600';
            default:
                return null;
        }
    }

    public function vat($case)
    {
        switch ($case) {
            case self::TYPE_PAYMENT:
                return 19;
            case self::TYPE_FEE:
                return 0;
            case self::TYPE_PAYOUT:
                return 0;
            default:
                return null;
        }
    }
}
