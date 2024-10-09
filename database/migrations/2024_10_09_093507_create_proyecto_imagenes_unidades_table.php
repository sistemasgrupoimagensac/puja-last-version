<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoImagenesUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_imagenes_unidades', function (Blueprint $table) {
            $table->id(); // Identificador de la imagen
            $table->unsignedBigInteger('proyecto_unidades_id'); // Relación con la tabla de unidades
            $table->unsignedBigInteger('proyecto_id'); // Relación con la tabla proyectos
            $table->string('image_url'); // URL de la imagen
            $table->boolean('estado')->default(1); // Estado de la imagen (1 = Activa, 0 = Inactiva)
            $table->string('descripcion')->nullable(); // Descripción de la imagen
            $table->timestamps();

            // Definir la relación con la tabla `proyecto_unidades`
            $table->foreign('proyecto_unidades_id')
                  ->references('id')
                  ->on('proyecto_unidades')
                  ->onDelete('cascade');

            // Definir la relación con la tabla `proyectos`
            $table->foreign('proyecto_id')
                  ->references('id')
                  ->on('proyectos')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_imagenes_unidades');
    }
}
