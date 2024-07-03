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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table: 'users');
            $table->string('codigo_unico', 200)->unique()->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('principal_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inmueble_id')->constrained(table: 'inmuebles');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('operaciones_tipos_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('principal_inmueble_id')->constrained(table: 'principal_inmuebles');
            $table->foreignId('tipo_operacion_id')->constrained(table: 'tipos_operaciones');
            $table->foreignId('tipo_inmueble_id')->constrained(table: 'tipos_inmuebles');
            $table->foreignId('subtipo_inmueble_id')->constrained(table: 'subtipos_inmuebles');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('ubicaciones_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('principal_inmueble_id')->constrained(table: 'principal_inmuebles');
            $table->string('direccion', 250)->nullable();
            $table->foreignId('departamento_id')->nullable()->constrained(table: 'departamentos');
            $table->foreignId('provincia_id')->nullable()->constrained(table: 'provincias');
            $table->foreignId('distrito_id')->nullable()->constrained(table: 'distritos');
            $table->string('latitud', 150)->nullable();
            $table->string('longitud', 150)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('caracteristicas_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('principal_inmueble_id')->constrained(table: 'principal_inmuebles');
            $table->integer('habitaciones')->nullable();
            $table->integer('banios')->nullable();
            $table->integer('medio_banios')->nullable();
            $table->integer('estacionamientos')->nullable();
            $table->float('area_construida')->nullable();
            $table->float('area_total')->nullable();
            $table->string('antiguedad', 150)->nullable();
            $table->integer('anios_antiguedad')->nullable();
            $table->float('precio_soles')->nullable();
            $table->float('precio_dolares')->nullable();
            
            $table->float('remate_precio_base')->nullable();
            $table->float('remate_valor_tasacion')->nullable();
            $table->string('remate_partida_registral', 250)->nullable();
            $table->string('remate_direccion', 250)->nullable();
            $table->string('remate_fecha', 15)->nullable();
            $table->string('remate_hora', 10)->nullable();
            $table->string('remate_nombre_contacto', 250)->nullable();
            $table->string('remate_telef_contacto', 250)->nullable();

            $table->string('titulo', 250)->nullable();
            $table->text('descripcion')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('multimedia_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inmueble_id')->constrained(table: 'inmuebles');
            $table->string('imagen_principal', 250)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('imagenes_multimedia_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('multimedia_inmueble_id')->constrained(table: 'multimedia_inmuebles');
            $table->string('imagen', 250)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('videos_multimedia_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('multimedia_inmueble_id')->constrained(table: 'multimedia_inmuebles');
            $table->string('video', 250)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('planos_multimedia_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('multimedia_inmueble_id')->constrained(table: 'multimedia_inmuebles');
            $table->string('plano', 250)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('extras_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inmueble_id')->constrained(table: 'inmuebles');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('extra_inmueble_caracteristicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extra_inmueble_id')->constrained(table: 'extras_inmuebles');
            $table->foreignId('caracteristica_extra_id')->constrained(table: 'caracteristicas_extra');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_multimedia_inmuebles');
        Schema::dropIfExists('videos_multimedia_inmuebles');
        Schema::dropIfExists('planos_multimedia_inmuebles');
        Schema::dropIfExists('multimedia_inmuebles');
        Schema::dropIfExists('extra_inmueble_caracteristicas');
        Schema::dropIfExists('extras_inmuebles');
        Schema::dropIfExists('operaciones_tipos_inmuebles');
        Schema::dropIfExists('ubicaciones_inmuebles');
        Schema::dropIfExists('caracteristicas_inmuebles');
        Schema::dropIfExists('principal_inmuebles');
        Schema::dropIfExists('inmuebles');
    }
};
