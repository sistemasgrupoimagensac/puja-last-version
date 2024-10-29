<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('caracteristicas_inmuebles', function (Blueprint $table) {
            $table->string('remate_nombre_centro')->nullable()->after('remate_direccion');
        });
    }

    public function down()
    {
        Schema::table('caracteristicas_inmuebles', function (Blueprint $table) {
            $table->dropColumn('remate_nombre_centro');
        });
    }

};
