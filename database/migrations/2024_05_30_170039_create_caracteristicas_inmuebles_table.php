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
        Schema::create('categoria_caracteristicas_extra', function (Blueprint $table) {
            $table->id();
            $table->string('categoria', 150);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('caracteristicas_extra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_caracteristica_id')->constrained(table: 'categoria_caracteristicas_extra');
            $table->string('caracteristica', 200);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caracteristicas_extra');
        Schema::dropIfExists('categoria_caracteristicas_extra');
    }
};
