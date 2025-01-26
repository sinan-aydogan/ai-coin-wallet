<?php

namespace App\Filament\Resources\ExchangeCenterResource\Pages;

use App\Filament\Resources\ExchangeCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExchangeCenters extends ListRecords
{
    protected static string $resource = ExchangeCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
