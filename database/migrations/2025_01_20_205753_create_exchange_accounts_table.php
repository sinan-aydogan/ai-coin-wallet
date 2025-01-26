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
        Schema::create('exchange_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('The name of the exchange account');
            $table->string('api_key')->comment('The API key of the exchange account');
            $table->string('api_secret')->nullable()->comment('The API secret of the exchange account');
            $table->string('api_passphrase')->nullable()->comment('The API passphrase of the exchange account');
            $table->foreignId('exchange_center_id')->constrained()->comment('The exchange center ID of the exchange account');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('The user ID of the exchange account');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('The status of the exchange account');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_accounts');
    }
};
