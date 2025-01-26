<?php

namespace App\Models;

use App\Enums\ExchangeCenterEndPointFunctionsEnum;
use App\Enums\ExchangeCenterEndPointTypesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeCenterEndPoint extends Model
{
    protected $fillable = [
        'exchange_center_id',
        'exchange_center_end_point_base_url_id',
        'name',
        'method',
        'url',
        'type',
        'function',
    ];

    protected $casts = [
        'type' => ExchangeCenterEndPointTypesEnum::class,
        'function' => ExchangeCenterEndPointFunctionsEnum::class,
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
