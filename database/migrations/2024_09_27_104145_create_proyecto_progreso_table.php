<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_progreso', function (Blueprint $table) {
            $table->id();
            $table->string('estado');  // Estado del proyecto (en planos, en construcción, entrega inmediata)
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_progreso');
    }
};
