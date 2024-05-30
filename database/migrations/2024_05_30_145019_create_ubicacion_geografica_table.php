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
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('provincias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id')->constrained(table: 'departamentos');
            $table->string('nombre', 150);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('distritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departamento_id')->constrained(table: 'departamentos');
            $table->foreignId('provincia_id')->constrained(table: 'provincias');
            $table->string('nombre', 200);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('provincias');
        Schema::dropIfExists('distritos');
    }
};
