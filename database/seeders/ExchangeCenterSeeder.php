<?php

namespace Database\Seeders;

use App\Enums\ExchangeCenterEndPointFunctionsEnum;
use App\Enums\ExchangeCenterEndPointTypesEnum;
use App\Models\ExchangeCenter;
use App\Models\ExchangeCenterEndPoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*Exchange Centers*/

        /* *
         * Binance
         * */
        $binance = ExchangeCenter::updateOrCreate([
            'name' => 'Binance',
        ]);
        /*Binance Base URLs*/
        $binance_base_url_v3 = $binance->exchangeCenterEndPointBaseUrls()->updateOrCreate([
            'name' => 'Main v3',
            'url' => 'https://api.binance.com/api/v3',
            'is_active' => true,
        ]);

        /*Binance Endpoints*/
        /*Get wallet info*/
        ExchangeCenterEndPoint::updateOrCreate([
            'exchange_center_id' => $binance->id,
            'exchange_center_end_point_base_url_id' => $binance_base_url_v3->id,
            'name' => 'Get Wallet Info',
            'method' => 'GET',
            'url' => '/account',
            'type' => ExchangeCenterEndPointTypesEnum::Private,
            'function' => ExchangeCenterEndPointFunctionsEnum::GetWallet,
        ]);




        /* *
         * BTC Türk
         * */
        $btcturk = ExchangeCenter::updateOrCreate([
            'name' => 'BTC Türk',
        ]);
        /*BTC Türk Base URLs*/
        $btcturk_base_url_v1 = $btcturk->exchangeCenterEndPointBaseUrls()->updateOrCreate([
            'name' => 'Main v1',
            'url' => 'https://www.btcturk.com/api/v1',
            'is_active' => true,
        ]);

        $btcturk_base_url_v2 = $btcturk->exchangeCenterEndPointBaseUrls()->updateOrCreate([
            'name' => 'Main v2',
            'url' => 'https://api.btcturk.com/api/v2',
            'is_active' => true,
        ]);

        /*BTC Türk Endpoints*/
        /*Get wallet info*/
        ExchangeCenterEndPoint::updateOrCreate([
            'exchange_center_id' => $btcturk->id,
            'exchange_center_end_point_base_url_id' => $btcturk_base_url_v1->id,
            'name' => 'Get Wallet Info',
            'method' => 'GET',
            'url' => '/users/balances',
            'type' => ExchangeCenterEndPointTypesEnum::Private,
            'function' => ExchangeCenterEndPointFunctionsEnum::GetWallet,
        ]);
    }
}
