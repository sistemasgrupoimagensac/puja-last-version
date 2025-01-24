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
        Schema::table('proyecto_planes_activos', function (Blueprint $table) {
            $table->boolean('pago_gratis')->default(false)->after('monto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyecto_planes_activos', function (Blueprint $table) {
            $table->dropColumn('pago_gratis');
        });
    }
};
