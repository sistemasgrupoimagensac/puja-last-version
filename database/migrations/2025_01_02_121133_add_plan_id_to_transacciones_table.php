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
        Schema::table('transacciones', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_id')->after('id')->nullable();

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transacciones', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn('plan_id');
        });
    }
};
