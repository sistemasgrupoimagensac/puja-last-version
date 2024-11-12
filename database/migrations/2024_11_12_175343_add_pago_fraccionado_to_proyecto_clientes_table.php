<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->boolean('pago_fraccionado')
                ->after('pago_unico');
        });
    }

    public function down()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->dropColumn(['pago_fraccionado']);
        });
    }
};
