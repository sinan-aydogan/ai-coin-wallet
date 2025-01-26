<?php

use App\Enums\ExchangeCenterEndPointFunctionsEnum;
use App\Enums\ExchangeCenterEndPointTypesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('exchange_center_end_points', function (Blueprint $table) {
            $table->enum('type', array_column(ExchangeCenterEndPointTypesEnum::cases(), 'value'))->default(ExchangeCenterEndPointTypesEnum::Private)->after('method')->comment('The type of the exchange center end point');
            $table->enum('function', array_column(ExchangeCenterEndPointFunctionsEnum::cases(), 'value'))->default(ExchangeCenterEndPointFunctionsEnum::GetWallet)->after('type')->comment('The function of the exchange center end point');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exchange_center_end_points', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('function');
        });
    }
};
