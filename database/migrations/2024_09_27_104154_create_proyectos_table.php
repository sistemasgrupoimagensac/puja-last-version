<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->integer('unidades_cantidad');  // Número de unidades en el proyecto
            $table->double('area_desde');  // Área mínima
            $table->double('area_hasta');  // Área máxima
            $table->double('area_techada_desde')->nullable();  // Área techada mínima
            $table->double('area_techada_hasta')->nullable();  // Área techada máxima
            $table->integer('dormitorios_desde');  // Número mínimo de dormitorios
            $table->integer('dormitorios_hasta');  // Número máximo de dormitorios
            $table->integer('banios_desde');  // Número mínimo de baños
            $table->integer('banios_hasta');  // Número máximo de baños
            $table->double('precio_desde');  // Precio más bajo de las unidades

            // Relación con la tabla proyecto_progreso (antes era progreso_proyecto)
            $table->foreignId('proyecto_progreso_id')->constrained('proyecto_progreso')->onDelete('cascade');

            // Relación con la tabla bancos
            $table->foreignId('banco_id')->constrained('bancos')->onDelete('cascade');

            $table->date('fecha_entrega')->nullable();  // Fecha estimada de entrega
            $table->text('descripcion');  // Descripción del proyecto
            $table->string('nombre_proyecto');  // Nombre del proyecto
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            // Eliminar las llaves foráneas antes de eliminar la tabla
            $table->dropForeign(['proyecto_progreso_id']);
            $table->dropForeign(['banco_id']);
        });

        Schema::dropIfExists('proyectos');
    }
};
