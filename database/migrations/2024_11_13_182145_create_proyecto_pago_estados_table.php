<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('proyecto_pago_estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique(); // Nombre del estado de pago, como 'pendiente', 'pagado', etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proyecto_pago_estados');
    }
};
