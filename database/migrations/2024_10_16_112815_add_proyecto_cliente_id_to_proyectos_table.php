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
        Schema::table('proyectos', function (Blueprint $table) {
            // Agregar la columna proyecto_cliente_id y su relación
            $table->foreignId('proyecto_cliente_id')
                ->after('id')  // Colocamos la columna después del campo 'id'
                ->constrained('proyecto_clientes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            // Eliminar la clave foránea y la columna proyecto_cliente_id
            $table->dropForeign(['proyecto_cliente_id']);
            $table->dropColumn('proyecto_cliente_id');
        });
    }
};
