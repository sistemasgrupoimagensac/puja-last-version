<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_contacts', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('proyecto_id'); // Foreign Key to the 'proyectos' table
            $table->unsignedBigInteger('user_id'); // Foreign Key to the 'users' table
            $table->string('status')->nullable(); // Estado del contacto
            $table->string('full_name'); // Nombre completo del contacto
            $table->string('email'); // Email del contacto
            $table->string('phone')->nullable(); // Teléfono del contacto
            $table->text('message')->nullable(); // Mensaje opcional
            $table->boolean('accept_terms')->default(false); // Aceptación de términos (default false)
            $table->string('time'); // Aceptación de términos (default false)
            $table->timestamps(); // Campos 'created_at' y 'updated_at'

            // Definir las relaciones con llaves foráneas
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade'); // Eliminar los contactos si el proyecto se borra
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Eliminar los contactos si el usuario se borra
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_contacts');
    }
}
