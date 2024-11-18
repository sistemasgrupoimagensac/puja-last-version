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

            // Agregar la clave foránea a `proyecto_pago_estados` con un valor predeterminado (por ejemplo, 'pendiente')
            $table->foreignId('estado_pago_id')
                ->default(1) // ID predeterminado que representa el estado inicial, como 'pendiente'
                ->constrained('proyecto_pago_estados')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('proyecto_cronograma_pagos', function (Blueprint $table) {
            $table->enum('estado', ['pendiente', 'pagado', 'fallido', 'reintento', 'fallo_final'])->default('pendiente'); // Restaurar el campo `estado`
            $table->dropForeign(['estado_pago_id']);
            $table->dropColumn('estado_pago_id');
        });
    }
};
