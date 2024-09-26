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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->integer('unidades');  // Número de unidades en el proyecto
            $table->double('area_desde');  // Área mínima
            $table->double('area_hasta');  // Área máxima
            $table->double('area_techada_desde')->nullable();  // Área techada mínima
            $table->double('area_techada_hasta')->nullable();  // Área techada máxima
            $table->integer('dormitorios_desde');  // Número mínimo de dormitorios
            $table->integer('dormitorios_hasta');  // Número máximo de dormitorios
            $table->integer('banios_desde');  // Número mínimo de baños
            $table->integer('banios_hasta');  // Número máximo de baños
            $table->double('precio_desde');  // Precio más bajo de las unidades
        
            // Relación con la tabla progreso_proyecto
            $table->unsignedBigInteger('progreso_proyecto_id');
            $table->foreign('progreso_proyecto_id')->references('id')->on('progreso_proyecto')->onDelete('cascade');
            
            // Relación con la tabla bancos
            $table->unsignedBigInteger('banco_id');
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');
            
            $table->date('fecha_entrega')->nullable();  // Fecha estimada de entrega
            $table->text('descripcion');  // Descripción del proyecto
            $table->string('nombre_proyecto');  // Nombre del proyecto
            
            $table->timestamps();  // Fechas de creación y actualización

            $table->engine = 'InnoDB'; 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
