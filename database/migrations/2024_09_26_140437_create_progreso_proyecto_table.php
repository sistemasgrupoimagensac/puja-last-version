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
        Schema::create('progreso_proyecto', function (Blueprint $table) {
            $table->id();
            $table->string('estado');  // Estado del proyecto (en planos, en construcción, entrega inmediata)
            $table->timestamps();  // Fechas de creación y actualización

            $table->engine = 'InnoDB'; 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progreso_proyecto');
    }
};
