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
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->integer('physical_proof_number')->nullable()->after('end_date');
            $table->string('file_name', 150)->nullable()->after('physical_proof_number');
            $table->string('state_et', 100)->nullable()->after('file_name');
            $table->integer('state_billed')->nullable()->after('state_et');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropColumn('physical_proof_number');
            $table->dropColumn('file_name');
            $table->dropColumn('state_et');
            $table->dropColumn('state_billed');
        });
    }
};
