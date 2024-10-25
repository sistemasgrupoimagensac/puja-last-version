<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->dropColumn(['nombre_contacto', 'telefono_contacto', 'email_contacto']);
        });
    }
    
    public function down()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->string('nombre_contacto')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->string('email_contacto')->nullable();
        });
    }
    
};
