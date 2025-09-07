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
        Schema::create('shipping_address', function (Blueprint $table) {
            $table->id();
            // Shipping Address can be related to a Customer or a Factory
            $table->foreignId('customer_id')->nullable()->constrained('customer');
            $table->foreignId('factory_id')->nullable()->constrained('factory');
            $table->string('address_to')->default('')->index();
            $table->string('street1')->default('')->index();
            $table->string('street2')->default('')->index();
            $table->foreignId('city_id')->nullable()->constrained('city');
            $table->foreignId('state_id')->nullable()->constrained('state');
            $table->foreignId('country_id')->nullable()->constrained('country');
            $table->string('postcode')->default('')->index();
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_default')->default(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_address');
    }
};
