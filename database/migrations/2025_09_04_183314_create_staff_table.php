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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('factory_id')->nullable()->constrained('factory');
            // - Store the user’s selection as an IANA timezone ID (e.g., "Asia/Shanghai", "America/New_York") in a nullable string column.
            $table->string('timezone')->nullable()->default('Asia/Shanghai');
            $table->string('full_name_english')->nullable()->default('')->index();
            $table->string('full_name_china')->nullable()->default('')->index();
            $table->string('phone')->nullable()->default('')->index();
            $table->string('wechat')->nullable()->default('')->index();
            $table->string('qq')->nullable()->default('')->index();
            $table->boolean('active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
