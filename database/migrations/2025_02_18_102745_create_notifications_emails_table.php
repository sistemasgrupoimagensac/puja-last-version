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
        Schema::create('notifications_emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('owner_name')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedTinyInteger('action_type')->description("1=para nuevos avisos publicados");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications_emails');
    }
};
