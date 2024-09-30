<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('proyecto_unidades', function (Blueprint $table) {
            $table->boolean('estado')->default(1); // 1: Activo, 0: Inactivo
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyecto_unidades', function (Blueprint $table) {
            //
        });
    }
};
