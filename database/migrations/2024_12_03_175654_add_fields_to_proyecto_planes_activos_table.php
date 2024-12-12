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
        Schema::table('proyecto_planes_activos', function (Blueprint $table) {
            $table->integer('numero_anuncios')->default(0)->after('monto');
            $table->boolean('pago_unico')->default(false)->after('numero_anuncios');
            $table->boolean('pago_fraccionado')->default(false)->after('pago_unico');
            $table->string('contrato_url')->nullable()->after('pago_fraccionado');
            $table->boolean('activo')->default(false)->after('contrato_url');
            $table->boolean('pagado')->default(false)->after('activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyecto_planes_activos', function (Blueprint $table) {
            $table->dropColumn([
                'numero_anuncios',
                'pago_unico',
                'pago_fraccionado',
                'contrato_url',
                'activo',
                'pagado',
            ]);
        });
    }
};
