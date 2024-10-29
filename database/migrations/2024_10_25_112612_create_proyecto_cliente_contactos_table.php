<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proyecto_cliente_contactos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_cliente_id')->constrained('proyecto_clientes')->onDelete('cascade'); // Llave foránea
            $table->string('nombre');
            $table->string('telefono');
            $table->string('email');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('proyecto_cliente_contactos');
    }
};
