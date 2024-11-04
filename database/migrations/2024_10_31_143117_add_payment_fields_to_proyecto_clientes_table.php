<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentFieldsToProyectoClientesTable extends Migration
{
    public function up()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->boolean('pagado')->default(false)->after('vigente');
            $table->decimal('precio_plan', 8, 2)->nullable()->after('pagado');
        });
    }

    public function down()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->dropColumn(['pagado', 'precio_plan']);
        });
    }
}