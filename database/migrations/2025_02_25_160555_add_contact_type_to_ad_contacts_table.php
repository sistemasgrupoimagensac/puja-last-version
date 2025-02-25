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
        Schema::table('ad_contacts', function (Blueprint $table) {
            $table->string('contact_type')->nullable()->after('aviso_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ad_contacts', function (Blueprint $table) {
            $table->dropColumn('contact_type');
        });
    }
};
