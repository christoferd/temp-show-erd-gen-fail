<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer', function(Blueprint $table)
        {
            $table->id();
            // Nullable because a customer can be created without a user, then later assigned to a user
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('account_manager_user_id')->nullable()->constrained('users');
            $table->string('abn')->nullable()->default('')->index();
            $table->string('company_name')->nullable()->default('')->index();
            $table->string('first_name')->nullable()->default('')->index();
            $table->string('last_name')->nullable()->default('')->index();
            $table->string('phone_1')->nullable()->default('')->index();
            $table->string('phone_2')->nullable()->default('')->index();
            $table->string('website')->nullable()->default('')->index();
            $table->string('brand_label')->nullable()->default('')->index();
            $table->foreignId('trade_term_id')->nullable()->constrained('trade_term');
            $table->foreignId('payment_term_id')->nullable()->constrained('payment_term');
            $table->foreignId('address_id')->nullable()->constrained('address');
            $table->json('shipping_addresses')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
