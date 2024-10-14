<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoClientesTable extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con la tabla 'users'
            $table->string('razon_social');
            $table->string('ruc');
            $table->string('direccion_fiscal');
            $table->string('telefono_inmobiliaria')->nullable();
            $table->string('nombre_comercial')->nullable();
            $table->string('representante_legal')->nullable();
            $table->string('direccion_representante')->nullable();
            $table->string('nombre_contacto');
            $table->string('telefono_contacto');
            $table->string('email_contacto');
            $table->date('fecha_inicio_contrato');
            $table->date('fecha_fin_contrato');
            $table->integer('numero_anuncios')->default(0); // Número de anuncios
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_clientes');
    }
}
