<?php

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
            $table
                ->foreignId('exchange_center_end_point_base_url_id')->constrained()->comment('The exchange center end point base URL ID of the exchange center end point')
                ->after('exchange_center_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exchange_center_end_points', function (Blueprint $table) {
            //
        });
    }
};
