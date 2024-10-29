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
        Schema::create('ad_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aviso_id')->default(1)->constrained(table: 'avisos');
            $table->foreignId('user_id')->nullable()->constrained(table: 'users');
            $table->boolean('status')->nullable()->default(0);
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->decimal('bid_amount', 10, 2)->nullable();
            $table->string('message', 250);
            $table->boolean('accept_terms')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_contacts');
    }
};
