<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExchangeCenter extends Model
{
    protected $fillable = [
        'name',
    ];

    public function exchangeCenterEndPointBaseUrls(): HasMany
    {
        return $this->hasMany(ExchangeCenterEndPointBaseUrl::class);
    }

    public function exchangeCenterEndPoints(): HasMany
    {
        return $this->hasMany(ExchangeCenterEndPoint::class);
    }
}
