<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('proyecto_cronograma_pago', function (Blueprint $table) {
            // Eliminar el campo `status` si existe
            $table->dropColumn('status');
            
            // Agregar la clave foránea a `proyecto_pago_estados`
            $table->foreignId('estado_pago_id')
                ->constrained('proyecto_pago_estados')
                ->onDelete('cascade'); // Opcional: elimina los pagos si se elimina el estado
        });
    }

    public function down()
    {
        Schema::table('proyecto_cronograma_pago', function (Blueprint $table) {
            $table->enum('status', ['pending', 'paid', 'failed', 'retrying', 'final_failed'])->default('pending'); // Restaurar el campo `status`
            $table->dropForeign(['estado_pago_id']);
            $table->dropColumn('estado_pago_id');
        });
    }
};
