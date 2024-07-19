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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained(table: 'packages')->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->integer('duration_in_days');
            $table->integer('total_ads')->nullable(); // Cantidad total de avisos permitidos por plan
            $table->integer('typical_ads')->nullable(); // Cantidad de avisos típicos permitidos por plan
            $table->integer('top_ads')->nullable(); // Cantidad de avisos top permitidos por plan
            $table->integer('premium_ads')->nullable(); // Cantidad de avisos premium permitidos por plan
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
