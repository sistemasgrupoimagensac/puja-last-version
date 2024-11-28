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
        Schema::create('proyecto_planes_estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre del estado, ejemplo: 'activo', 'vencido', etc.
            $table->string('descripcion')->nullable(); // Descripción opcional del estado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_planes_estados');
    }
};
