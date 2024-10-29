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
        Schema::create('proyecto_cliente_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_cliente_id')->constrained('proyecto_clientes')->onDelete('cascade');
            $table->string('google_sheet_url')->nullable();
            $table->boolean('sheet_habilitado')->default(false);
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_cliente_sheets');
    }
};
