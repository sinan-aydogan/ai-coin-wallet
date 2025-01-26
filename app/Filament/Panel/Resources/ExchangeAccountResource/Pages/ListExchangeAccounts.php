<?php

namespace App\Filament\Panel\Resources\ExchangeAccountResource\Pages;

use App\Filament\Panel\Resources\ExchangeAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExchangeAccounts extends ListRecords
{
    protected static string $resource = ExchangeAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
