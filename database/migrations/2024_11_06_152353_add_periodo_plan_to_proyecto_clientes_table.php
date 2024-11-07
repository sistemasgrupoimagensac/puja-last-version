<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeriodoPlanToProyectoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->integer('periodo_plan')->nullable()->after('pagado')->comment('Periodo del plan en meses (3, 6, 12)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->dropColumn('periodo_plan');
        });
    }
}
