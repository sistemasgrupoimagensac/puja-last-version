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
        Schema::create('fact_electronica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->string('ruc', 40)->unique();
            $table->string('business_name', 255);
            $table->string('tradename', 255);
            $table->string('ubigeo', 40);
            $table->string('department', 100);
            $table->string('province', 100);
            $table->string('district', 100);
            $table->string('address', 255);
            $table->string('phone', 40);
            $table->string('message_print', 255)->nullable();
            $table->string('certificate_name', 100)->nullable();
            $table->string('certificate_pass', 100)->nullable();
            $table->string('sol_user', 100)->nullable();
            $table->string('sol_password', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fact_electronica');
    }
};
