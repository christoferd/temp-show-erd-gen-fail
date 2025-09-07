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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('address_to')->default('');
            $table->string('street1')->default('');
            $table->string('street2')->default('');
            $table->foreignId('city_id')->nullable()->constrained('city');
            $table->foreignId('state_id')->nullable()->constrained('state');
            $table->foreignId('country_id')->nullable()->constrained('country');
            $table->string('postcode')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
