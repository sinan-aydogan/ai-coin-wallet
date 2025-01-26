<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ExchangeCenterEndPointFunctionsEnum: string implements HasLabel
{
    case GetWallet = 'get_wallet';

    public function getLabel(): string
    {
        return match ($this) {
            self::GetWallet => trans('ec.ep.functions.get_balance'),
        };
    }
}
