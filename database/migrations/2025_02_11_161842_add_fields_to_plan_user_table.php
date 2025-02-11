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
        Schema::table('plan_user', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable()->after('plan_id');
            $table->decimal('promo1', 8, 2)->nullable()->after('price');
            $table->decimal('promo2', 8, 2)->nullable()->after('promo1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_user', function (Blueprint $table) {
            $table->dropColumn(['promo1', 'promo2', 'price']);
        });
    }
};
