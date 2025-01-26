<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExchangeCenterEndPointBaseUrl extends Model
{
    protected $fillable = [
        'exchange_center_id',
        'name',
        'url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function exchangeCenter(): BelongsTo
    {
        return $this->belongsTo(ExchangeCenter::class);
    }

    public function exchangeCenterEndPoints(): HasMany
    {
        return $this->hasMany(ExchangeCenterEndPoint::class);
    }
}
