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
        Schema::create('aviso_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aviso_id')->nullable();
            $table->string('type')->nullable();
            $table->json('request')->nullable();
            $table->json('response')->nullable();
            $table->boolean('success')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('aviso_id')->references('id')->on('avisos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aviso_logs');
    }
};
