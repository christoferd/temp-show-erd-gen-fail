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
        Schema::create('factory', function (Blueprint $table) {
            $table->id();
            $table->string('name_english')->default('')->nullable()->default('')->index();
            $table->string('name_china')->default('')->nullable()->default('')->index();
            $table->string('phone_1')->default('');
            $table->string('phone_2')->default('');
            $table->string('email')->default('');
            $table->string('website')->default('');
            $table->foreignId('address_id')->nullable()->constrained('address');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factory');
    }
};
