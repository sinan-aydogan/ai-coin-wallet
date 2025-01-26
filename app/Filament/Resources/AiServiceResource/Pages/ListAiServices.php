<?php

namespace App\Filament\Resources\AiServiceResource\Pages;

use App\Filament\Resources\AiServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAiServices extends ListRecords
{
    protected static string $resource = AiServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
