<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoImagenesAdicionalesTable extends Migration
{
    public function up()
    {
        Schema::create('proyecto_imagenes_adicionales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id'); // Llave foránea hacia la tabla `proyectos`
            $table->string('image_url'); // URL de la imagen adicional en Wasabi
            $table->string('descripcion')->nullable(); // Descripción opcional de la imagen
            $table->string('tipo')->nullable(); // Tipo de imagen (opcional)
            $table->integer('orden')->nullable(); // Orden de la imagen en la galería
            $table->integer('estado')->default(1); // Campo de estado (1 = activa, 0 = eliminada)
            $table->timestamps();

            // Definir la relación con `proyectos`
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyecto_imagenes_adicionales');
    }
}
