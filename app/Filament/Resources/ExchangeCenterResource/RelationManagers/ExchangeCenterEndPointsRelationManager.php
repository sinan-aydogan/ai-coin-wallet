<?php

namespace App\Filament\Resources\ExchangeCenterResource\RelationManagers;

use App\Enums\ExchangeCenterEndPointFunctionsEnum;
use App\Enums\ExchangeCenterEndPointTypesEnum;
use App\Models\ExchangeCenterEndPointBaseUrl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExchangeCenterEndPointsRelationManager extends RelationManager
{
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans_choice("ec.ep.model_label",2);
    }

    public static function getModelLabel(): string
    {
        return trans_choice("ec.ep.model_label", 1);
    }

    protected static string $relationship = 'exchangeCenterEndPoints';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Name*/
                Forms\Components\TextInput::make('name')
                    ->label(trans('ec.ep.name'))
                    ->columnSpan(2)
                    ->required(),
                /*Borsa*/
                Forms\Components\Select::make('exchange_center_id')
                    ->label(trans_choice('ec.model_label',1))
                    ->relationship('exchangeCenter', 'name')
                    ->live()
                    ->required(),
                /*Type:Enum*/
                Forms\Components\Select::make('type')
                    ->label(trans('ec.ep.type'))
                    ->options(ExchangeCenterEndPointTypesEnum::class)
                    ->required(),
                /*Function*/
                Forms\Components\Select::make('function')
                    ->label(trans('ec.ep.function'))
                    ->options(ExchangeCenterEndPointFunctionsEnum::class)
                    ->required(),
                /*Method*/
                Forms\Components\Select::make('method')
                    ->label(trans('ec.ep.method'))
                    ->options([
                        'GET' => 'GET',
                        'POST' => 'POST',
                        'PUT' => 'PUT',
                        'PATCH' => 'PATCH',
                        'DELETE' => 'DELETE',
                    ])
                    ->required(),
                /*Base URL*/
                Forms\Components\Select::make('exchange_center_end_point_base_url_id')
                    ->label(trans_choice('ec.ep.bu.model_label',1))
                    ->options(fn (Get $get) => ExchangeCenterEndPointBaseUrl::where('exchange_center_id', $get('exchange_center_id'))->get()->pluck('name','id')->toArray() ?? []),
                /*URL*/
                Forms\Components\TextInput::make('url')
                    ->label(trans('ec.ep.url'))
                    ->columnSpan(2)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                /*Name*/
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(trans('ec.ep.name')),
                /*Borsa*/
                Tables\Columns\TextColumn::make('exchangeCenter.name')
                    ->searchable()
                    ->sortable()
                    ->label(trans_choice('ec.model_label',2)),
                /*Method*/
                Tables\Columns\TextColumn::make('method')
                    ->searchable()
                    ->sortable()
                    ->label(trans('ec.ep.method')),
                /*URL*/
                Tables\Columns\TextColumn::make('url')
                    ->searchable()
                    ->sortable()
                    ->label(trans('ec.ep.url')),
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
