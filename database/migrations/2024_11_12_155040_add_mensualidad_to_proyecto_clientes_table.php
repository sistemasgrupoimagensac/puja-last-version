<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->decimal('mensualidad', 10, 2)->nullable()->after('precio_plan')->comment('Cuota mensual en caso de pago fraccionado');
        });
    }
    
    public function down()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->dropColumn('mensualidad');
        });
    }    
};
