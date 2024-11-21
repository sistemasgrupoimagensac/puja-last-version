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
        Schema::create('proyecto_planes_activos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_cliente_id')->constrained('proyecto_clientes')->onDelete('cascade'); // Elimina los planes si el cliente es eliminado
            $table->foreignId('proyecto_planes_id')->constrained('proyecto_planes')->onDelete('cascade');
            $table->date('fecha_inicio'); // Fecha de inicio del plan
            $table->date('fecha_fin'); // Fecha de fin del plan
            $table->decimal('monto', 10, 2); // Monto total del plan
            $table->integer('duracion'); // Duración del plan en meses
            $table->boolean('renovacion_automatica')->default(false); // Renovación automática
            $table->enum('estado', ['activo', 'vencido', 'renovado', 'dado de baja'])
                  ->default('activo'); // Estado del plan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_planes_activos');
    }
};
