<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AiServiceProvidersEnum: string implements HasLabel
{
    /*OpenAi, Gemini*/
    case OpenAi = 'openai';
    case Gemini = 'gemini';

    public function getLabel(): string
    {
        return $this->name;
    }
}
