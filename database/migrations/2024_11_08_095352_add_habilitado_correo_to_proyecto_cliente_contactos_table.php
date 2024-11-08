<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proyecto_cliente_contactos', function (Blueprint $table) {
            $table->boolean('habilitado_correo')->default(false)->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('proyecto_cliente_contactos', function (Blueprint $table) {
            $table->dropColumn('habilitado_correo');
        });
    }
};

