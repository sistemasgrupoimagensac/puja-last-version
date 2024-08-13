<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caracteristicas_inmuebles', function (Blueprint $table) {
            $table->string('remate_correo_contacto', 250)->nullable()->after('remate_telef_contacto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caracteristicas_inmuebles', function (Blueprint $table) {
            $table->dropColumn('remate_correo_contacto');
        });
    }
};
