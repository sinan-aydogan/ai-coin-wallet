<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExchangeCenterResource\Pages;
use App\Filament\Resources\ExchangeCenterResource\RelationManagers;
use App\Models\ExchangeCenter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExchangeCenterResource extends Resource
{
    public static function getModelLabel(): string
    {
        return trans_choice("ec.model_label",2);
    }

    protected static ?string $model = ExchangeCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Name*/
                Forms\Components\TextInput::make('name')
                    ->label(trans('ec.name'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /*Name*/
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(trans('ec.name'))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            'exchangeCenterEndPointBaseUrls' => RelationManagers\ExchangeCenterEndPointBaseUrlsRelationManager::class,
            'exchangeCenterEndPoints' => RelationManagers\ExchangeCenterEndPointsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExchangeCenters::route('/'),
            'create' => Pages\CreateExchangeCenter::route('/create'),
            'edit' => Pages\EditExchangeCenter::route('/{record}/edit'),
        ];
    }
}
