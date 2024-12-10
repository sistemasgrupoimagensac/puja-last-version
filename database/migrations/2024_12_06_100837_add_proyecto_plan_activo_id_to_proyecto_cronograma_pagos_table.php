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
        Schema::table('proyecto_cronograma_pagos', function (Blueprint $table) {
            $table->foreignId('proyecto_plan_activo_id')
                ->after('proyecto_cliente_id')
                ->constrained('proyecto_planes_activos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyecto_cronograma_pagos', function (Blueprint $table) {
            $table->dropForeign(['proyecto_plan_activo_id']);
            $table->dropColumn('proyecto_plan_activo_id');
        });
    }
};
