<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Renombrar la tabla de `customer_cards` a `proyecto_cliente_tarjeta`
        Schema::rename('customer_cards', 'proyecto_cliente_tarjetas');

        // Actualizar la clave foránea en la tabla renombrada
        Schema::table('proyecto_cliente_tarjetas', function (Blueprint $table) {
            $table->renameColumn('user_id', 'proyecto_cliente_id'); // Renombrar columna `user_id` a `proyecto_cliente_id`
        });
    }

    public function down()
    {
        // Revertir el cambio de nombre de la tabla
        Schema::rename('proyecto_cliente_tarjetas', 'customer_cards');

        // Revertir el cambio de nombre de la columna
        Schema::table('customer_cards', function (Blueprint $table) {
            $table->renameColumn('proyecto_cliente_id', 'user_id');
        });
    }
};