<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_unidades', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla proyectos usando la sintaxis de foreignId y constrained
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');

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

    public function down(): void
    {
        Schema::table('proyecto_unidades', function (Blueprint $table) {
            // Eliminar las llaves foráneas antes de eliminar la tabla
            $table->dropForeign(['proyecto_id']);
        });

        Schema::dropIfExists('proyecto_unidades');  // Asegúrate de que coincida con el nombre definido en up()
    }
};
