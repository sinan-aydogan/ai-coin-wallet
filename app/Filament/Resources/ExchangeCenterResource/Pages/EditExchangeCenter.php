<?php

namespace App\Filament\Resources\ExchangeCenterResource\Pages;

use App\Filament\Resources\ExchangeCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExchangeCenter extends EditRecord
{
    protected static string $resource = ExchangeCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
