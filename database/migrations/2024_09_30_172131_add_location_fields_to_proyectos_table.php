<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationFieldsToProyectosTable extends Migration
{
    /**
     * Ejecutar la migración.
     */
    public function up()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            // Agregar campos para la ubicación
            $table->string('direccion')->nullable()->after('descripcion');  // Dirección
            $table->string('distrito')->nullable()->after('direccion');     // Distrito
            $table->string('provincia')->nullable()->after('distrito');     // Provincia
            $table->string('departamento')->nullable()->after('provincia'); // Departamento
            $table->decimal('latitude', 10, 7)->nullable()->after('departamento'); // Latitud con precisión
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');    // Longitud con precisión
        });
    }

    /**
     * Revertir la migración.
     */
    public function down()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            // Eliminar los campos de ubicación si se hace una reversión
            $table->dropColumn('direccion');
            $table->dropColumn('distrito');
            $table->dropColumn('provincia');
            $table->dropColumn('departamento');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
