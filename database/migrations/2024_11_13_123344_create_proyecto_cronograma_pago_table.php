<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('proyecto_cronograma_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_cliente_id')->constrained('proyecto_clientes')->onDelete('cascade'); // Clave foránea corregida
            $table->date('fecha_programada'); // Fecha programada para el cobro
            $table->decimal('monto', 10, 2); // Monto a debitar
            $table->enum('estado', ['pendiente', 'pagado', 'fallido', 'en_reintento', 'fallo_final'])->default('pendiente'); // Estado del pago en español
            $table->unsignedInteger('intentos')->default(0); // Cantidad de intentos de cobro realizados
            $table->date('reintento_hasta')->nullable(); // Fecha límite para reintentos
            $table->dateTime('fecha_ultimo_intento')->nullable(); // Fecha del último intento
            $table->string('razon_fallo')->nullable(); // Razón de falla
            $table->boolean('fallo_final')->default(false); // Indica si el pago ha fallado después de todos los reintentos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyecto_cronograma_pagos');
    }
};
