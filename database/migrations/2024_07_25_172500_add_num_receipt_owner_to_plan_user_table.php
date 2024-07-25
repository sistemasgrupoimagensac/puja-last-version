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
        Schema::table('plan_user', function (Blueprint $table) {
            $table->string('num_receipt_owner')->nullable()->after('document_type_id');
            $table->string('name_receipt_owner')->nullable()->after('num_receipt_owner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_user', function (Blueprint $table) {
            $table->dropColumn('num_receipt_owner');
            $table->dropColumn('name_receipt_owner');
        });
    }
};
