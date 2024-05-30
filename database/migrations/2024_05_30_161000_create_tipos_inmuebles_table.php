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
        Schema::create('tipos_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 200);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('subtipos_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_inmueble_id')->constrained(table: 'tipos_inmuebles');
            $table->string('subtipo', 200);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('tipos_operaciones', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 150);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_inmuebles');
        Schema::dropIfExists('subtipos_inmuebles');
        Schema::dropIfExists('tipos_operaciones');
    }
};
