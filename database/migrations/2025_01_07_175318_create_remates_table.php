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
        Schema::create('remates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('numero_remate')->nullable(1);
            $table->foreignId('caracteristicas_inmueble_id')
                ->constrained('caracteristicas_inmuebles')
                ->onDelete('cascade');
            $table->decimal('base_remate', 15, 2)->nullable();
            $table->decimal('valor_tasacion', 15, 2)->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remates');
    }
};
