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
        Schema::create('exchange_center_end_point_base_urls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exchange_center_id')->constrained()->comment('The exchange center ID of the exchange center end point base URL');
            $table->string('name')->comment('The name of the exchange center end point base URL');
            $table->string('url')->comment('The base URL of the exchange center end point base URL');
            $table->boolean('is_active')->default(true)->comment('The status of the exchange center end point base URL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_center_end_point_base_urls');
    }
};
