<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->boolean('pago_unico')
                ->after('precio_plan')
                ->comment('1: Pago único, 0: Pago fraccionado');

            $table->boolean('renovacion')
                ->after('pago_unico')
                ->comment('1: Renovación automática, 0: Sin renovación');
        });
    }

    public function down()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->dropColumn(['pago_unico', 'renovacion']);
        });
    }
};
