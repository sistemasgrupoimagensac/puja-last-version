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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('state')->default(1);
            $table->tinyInteger('status_electronic_billing')->default(0)->comment('Estatus de Fact. Electronica 0 en Beta (Pruebas), 1 envio Real');
            $table->string('name', 150);
            $table->string('logo', 100)->nullable();
            $table->string('logo_menu', 100)->nullable();
            $table->string('path', 255)->nullable()->comment('Ruta a la carpeta publica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
