<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('proyecto_cronograma_pagos', function (Blueprint $table) {
            // Eliminar el campo `estado` si existe
            $table->dropColumn('estado');

            // Agregar la clave foránea a `proyecto_pago_estados` con un valor predeterminado después de `fallo_final`
            $table->foreignId('estado_pago_id')
                ->default(1) // ID predeterminado que representa el estado inicial, como 'pendiente'
                ->after('fallo_final') // Ubicar el campo después de `fallo_final`
                ->constrained('proyecto_pago_estados')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('proyecto_cronograma_pagos', function (Blueprint $table) {
            // Restaurar el campo `estado` en la posición final
            $table->enum('estado', ['pendiente', 'pagado', 'fallido', 'reintento', 'fallo_final'])->default('pendiente');

            // Eliminar la clave foránea y el campo `estado_pago_id`
            $table->dropForeign(['estado_pago_id']);
            $table->dropColumn('estado_pago_id');
        });
    }
};
