<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proyecto_cliente_legales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_cliente_id')->constrained('proyecto_clientes')->onDelete('cascade');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('tipo_documento');
            $table->string('numero_documento'); // Añadir el campo aquí
            $table->string('estado_civil')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_cliente_legales');
    }
};
