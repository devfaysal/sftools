<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlentyMarketProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS_ACTIVE = 'Active';
    public const STATUS_INACTIVE = 'Inactive';
    public const STATUS_IMPORTED = 'Imported';
    public const STATUS_INVALID_MU_ID = 'Invalid MU Id';
    public const STATUS_INVALID_MS_ID = 'Invalid MS Id';
    public const STATUS_INVALID_ON_ID = 'Invalid ON Id';
    public const STATUS_NAME_MISS_MATCH = 'Name missmatch';
    public const STATUS_STOCK_UPDATE_FAILED = 'Stock update failed';

    public function scopeActive(Builder $query):Builder
    {
        return $query->whereStatus(self::STATUS_ACTIVE);
    }
    
    public function scopeImported(Builder $query):Builder
    {
        return $query->whereStatus(self::STATUS_IMPORTED);
    }

}
