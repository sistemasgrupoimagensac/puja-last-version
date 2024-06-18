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
        Schema::create('estados_avisos', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 150);
            $table->string('color', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('avisos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inmueble_id')->constrained(table: 'inmuebles');
            $table->dateTime('fecha_publicacion')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('historial_avisos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aviso_id')->constrained(table: 'avisos');
            $table->foreignId('estado_aviso_id')->constrained(table: 'estados_avisos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_avisos');
        Schema::dropIfExists('estados_avisos');
        Schema::dropIfExists('avisos');
    }
};
