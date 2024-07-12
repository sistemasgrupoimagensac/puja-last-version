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
        Schema::create('subscription_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_level_id')->constrained(table: 'subscription_levels')->onDelete('cascade');
            $table->integer('num_ads_typical')->nullable(); // cantidad de avisos típicos
            $table->integer('num_ads_top')->nullable(); // cantidad de avisos top
            $table->integer('num_ads_top_plus')->nullable(); // cantidad de avisos top plus
            $table->integer('num_days'); // cantidad de días
            $table->decimal('price', 8, 2); // precio
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_options');
    }
};
