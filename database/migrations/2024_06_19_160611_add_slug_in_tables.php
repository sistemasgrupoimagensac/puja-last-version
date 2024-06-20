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
        Schema::table('tipos_inmuebles', function (Blueprint $table) {
            $table->string('plural', 200)->nullable()->after('tipo');
            $table->string('slug', 200)->nullable()->after('plural');
        });

        Schema::table('tipos_operaciones', function (Blueprint $table) {
            $table->string('plural', 150)->nullable()->after('tipo');
            $table->string('slug', 150)->nullable()->after('plural');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipos_inmuebles', function (Blueprint $table) {
            $table->dropColumn(['plural', 'slug']);
        });

        Schema::table('tipos_operaciones', function (Blueprint $table) {
            $table->dropColumn(['plural', 'slug']);
        });
    }
};
