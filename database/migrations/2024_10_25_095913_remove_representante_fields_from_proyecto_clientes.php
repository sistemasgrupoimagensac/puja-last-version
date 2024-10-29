<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->dropColumn(['representante_legal', 'direccion_representante']);
        });
    }
    
    public function down()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->string('representante_legal')->nullable();
            $table->string('direccion_representante')->nullable();
        });
    }
    
};
