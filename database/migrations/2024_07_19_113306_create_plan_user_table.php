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
        Schema::create('plan_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table: 'users')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained(table: 'plans')->onDelete('cascade');
            $table->foreignId('document_type_id')->nullable()->constrained(table: 'tipo_documentos')->onDelete('cascade');
            $table->boolean('estado')->default(1);
            $table->integer('typical_ads_remaining')->default(0);
            $table->integer('top_ads_remaining')->default(0);
            $table->integer('premium_ads_remaining')->default(0);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('physical_proof_number')->nullable();
            $table->string('file_name', 150)->nullable();
            $table->string('state_et', 100)->nullable();
            $table->integer('state_billed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_user');
    }
};
