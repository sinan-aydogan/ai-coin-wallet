<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ExchangeCenterEndPointTypesEnum: string implements HasLabel
{
    case Private = 'private';
    case Public = 'public';

    public function getLabel(): string
    {
        return match ($this) {
            self::Public => trans('ec.ep.types.public'),
            self::Private => trans('ec.ep.types.private'),
        };
    }
}
