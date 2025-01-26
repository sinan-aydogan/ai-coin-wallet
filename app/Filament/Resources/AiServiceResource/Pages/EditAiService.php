<?php

namespace App\Filament\Resources\AiServiceResource\Pages;

use App\Filament\Resources\AiServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAiService extends EditRecord
{
    protected static string $resource = AiServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
