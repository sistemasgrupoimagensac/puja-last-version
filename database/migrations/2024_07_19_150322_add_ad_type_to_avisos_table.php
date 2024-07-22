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
        Schema::table('avisos', function (Blueprint $table) {
            $table->integer('ad_type')->after('inmueble_id')->nullable();
            $table->foreignId('plan_user_id')->nullable()->constrained(table: 'plan_user')->after('ad_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('avisos', function (Blueprint $table) {
            $table->dropForeign(['plan_user_id']);
            $table->dropColumn(['ad_type', 'plan_user_id']);
        });
    }
};
