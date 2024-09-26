<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unidad_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');  // Relación con la tabla proyectos
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
            
            $table->integer('dormitorios');  // Número de dormitorios en la unidad
            $table->double('precio_soles')->nullable();  // Precio en soles
            $table->double('precio_dolares')->nullable();  // Precio en dólares
            $table->double('area');  // Área de la unidad
            $table->double('area_techada')->nullable();  // Área techada de la unidad
            $table->integer('banios');  // Número de baños
            $table->integer('piso_numero');  // Piso en el que se encuentra la unidad
            
            $table->timestamps();  // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_proyecto');
    }
};
