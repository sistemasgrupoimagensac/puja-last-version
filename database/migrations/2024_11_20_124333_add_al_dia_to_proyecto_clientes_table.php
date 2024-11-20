<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->boolean('al_dia')->default(false)->after('pagado');
        });
    }
    
    public function down()
    {
        Schema::table('proyecto_clientes', function (Blueprint $table) {
            $table->dropColumn('al_dia');
        });
    }
    
};
