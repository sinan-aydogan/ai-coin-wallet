<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeAccount extends Model
{
    protected $fillable = [
        'name',
        'exchange_center_id',
        'api_key',
        'api_secret',
        'api_passphrase',
        'user_id',
        'status',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(static function (ExchangeAccount $exchangeAccount) {
            if (auth()->hasUser()) {
                $exchangeAccount->user_id = auth()->user()->id;
            }
        });
    }

    public function exchangeCenter(): BelongsTo
    {
        return $this->belongsTo(ExchangeCenter::class);
    }
}
