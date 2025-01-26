<?php

namespace App\Filament\Panel\Resources;

use App\Filament\Panel\Resources\ExchangeAccountResource\Pages;
use App\Filament\Panel\Resources\ExchangeAccountResource\RelationManagers;
use App\Models\ExchangeAccount;
use App\Models\ExchangeCenter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExchangeAccountResource extends Resource
{
    public static function getModelLabel(): string
    {
        return trans_choice("ea.model_label",2);
    }

    protected static ?string $model = ExchangeAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Name*/
                Forms\Components\TextInput::make('name')
                    ->label(trans('ea.name'))
                    ->required(),
                /*Exchange Center*/
                Forms\Components\Select::make('exchange_center_id')
                    ->label(trans('ea.exchange_center'))
                    ->relationship('exchangeCenter', 'name')
                    ->live()
                    ->required(),
                /*API Key*/
                Forms\Components\TextInput::make('api_key')
                    ->label(trans('ea.api_key'))
                    ->required(),
                /*API Secret*/
                Forms\Components\TextInput::make('api_secret')
                    ->label(trans('ea.api_secret'))
                    ->required(fn(Get $get):bool=>(int) $get('exchange_center_id') === ExchangeCenter::where('name', 'BTC Türk')->first()->id),
                /*API Passphrase*/
                Forms\Components\TextInput::make('api_passphrase')
                ->label(trans('ea.api_passphrase')),
                /*Status*/
                Forms\Components\Select::make('status')
                ->label(trans('ea.status'))
                ->options([
                    'active' => trans('ea.status_options.active'),
                    'inactive' => trans('ea.status_options.inactive'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /*Name*/
                Tables\Columns\TextColumn::make('name')
                    ->label(trans('ea.name'))
                    ->searchable()
                    ->sortable(),
                /*Exchange Center*/
                Tables\Columns\TextColumn::make('exchangeCenter.name')
                    ->label(trans('ea.exchange_center'))
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('getWallet')
                    ->label(trans('ec.ep.functions.get_balance'))
                    ->icon('heroicon-o-wallet')
                    ->action(function (ExchangeCenter $record) {
                        // Burada cüzdan bilgisini çekecek kodu çağıracağız.
                        $walletData = $this->fetchWalletData($record);
                        // Cüzdan bilgisini bir notification veya modal ile gösterebilirsiniz.
                        $this->showWalletData($walletData);
                    }),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExchangeAccounts::route('/'),
            'create' => Pages\CreateExchangeAccount::route('/create'),
            'edit' => Pages\EditExchangeAccount::route('/{record}/edit'),
        ];
    }

    private function fetchWalletData(ExchangeCenter $exchangeCenter)
    {
        // Borsanın endpoint'ini al
        $endpoint = $exchangeCenter->exchangeCenterEndPoints()->wallet_endpoint;

        // API key ve secret gibi bilgileri kullanarak istek yap
        $response = Http::withHeaders([
            'X-MBX-APIKEY' => $exchangeCenter->api_key,
        ])->get($endpoint, [
            'timestamp' => now()->timestamp,
            'signature' => $this->generateSignature($exchangeCenter),
        ]);

        // İstek başarılı ise veriyi döndür
        if ($response->successful()) {
            return $response->json();
        }

        // Hata durumunda null döndür veya hata fırlat
        return null;
    }
}
