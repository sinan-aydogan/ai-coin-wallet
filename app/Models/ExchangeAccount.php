<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
            /*Set User*/
            if (auth()->hasUser()) {
                $exchangeAccount->user_id = auth()->user()->id;
            }
        });
    }

    protected function apiKey(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => decrypt($value),
            set: static fn ($value) => encrypt($value)
        );
    }

    protected function apiSecret(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => decrypt($value),
            set: static fn ($value) => encrypt($value)
        );
    }

    protected function apiPassphrase(): Attribute
    {
        return Attribute::make(
            get: static fn ($value) => decrypt($value),
            set: static fn ($value) => encrypt($value)
        );
    }

    public function exchangeCenter(): BelongsTo
    {
        return $this->belongsTo(ExchangeCenter::class);
    }
}
