<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeCenterEndPoint extends Model
{
    protected $fillable = [
        'exchange_center_id',
        'name',
        'method',
        'url',
    ];

    public function exchangeCenter():BelongsTo
    {
        return $this->belongsTo(ExchangeCenter::class);
    }

    public function exchangeCenterEndPointBaseUrl(): BelongsTo
    {
        return $this->belongsTo(ExchangeCenterEndPointBaseUrl::class);
    }
}
