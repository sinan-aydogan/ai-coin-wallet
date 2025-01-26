<?php

namespace App\Filament\Resources\ExchangeCenterResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExchangeCenterEndPointBaseUrlsRelationManager extends RelationManager
{
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans_choice("ec.ep.bu.model_label", 2);
    }

    public static function getModelLabel(): string
    {
        return trans_choice("ec.ep.bu.model_label", 1);
    }

    protected static string $relationship = 'exchangeCenterEndPointBaseUrls';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Name*/
                Forms\Components\TextInput::make('name')
                    ->label(trans('ec.ep.bu.name'))
                    ->required()
                    ->maxLength(255),
                /*URL*/
                Forms\Components\TextInput::make('url')
                ->label(trans('ec.ep.bu.url'))
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                /*Name*/
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('ec.ep.bu.name'))
                    ->searchable()
                    ->sortable(),
                /*URL*/
                Tables\Columns\TextColumn::make('url')
                    ->label(trans('ec.ep.bu.url'))
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
