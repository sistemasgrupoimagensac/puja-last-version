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
            $table->dateTime('fecha_vencimiento')->nullable()->after('fecha_publicacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('avisos', function (Blueprint $table) {
            $table->dropColumn('fecha_vencimiento');
        });
    }
};
