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
        Schema::table('users', function(Blueprint $table)
        {
            // - Store the user’s selection as an IANA timezone ID (e.g. "Asia/Shanghai", "America/New_York") in a nullable string column.
            $table->boolean('is_active')->default(true)->index()->after('password');
            $table->string('timezone')->nullable()->default('Asia/Shanghai')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('timezone');
        });
    }
};
