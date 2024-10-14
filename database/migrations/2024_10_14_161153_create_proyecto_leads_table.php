<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoLeadsTable extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_leads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('correo');
            $table->string('telefono');
            $table->text('mensaje')->nullable();
            $table->enum('estado', ['contactado', 'sin_contactar'])->default('sin_contactar');
            $table->boolean('respondio')->default(false);
            $table->boolean('interesado')->default(false);
            $table->date('fecha_contacto')->nullable(); // Para guardar la fecha en la que se contactó al lead
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_leads');
    }
}
