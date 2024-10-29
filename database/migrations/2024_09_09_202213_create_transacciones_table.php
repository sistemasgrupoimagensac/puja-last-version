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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            // Información general de la transacción
            $table->decimal('amount', 10, 2)->nullable(); // Monto de la transacción
            $table->string('currency', 10)->nullable(); // Moneda

            // Datos del cliente
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone_number')->nullable();

            // Datos de la tarjeta
            $table->string('card_bank_code')->nullable(); // Código del banco
            $table->string('card_bank_name')->nullable(); // Nombre del banco
            $table->string('card_holder_name')->nullable(); // Titular de la tarjeta
            $table->string('card_type')->nullable(); // Tipo de tarjeta (débito/crédito)

            // Plan y descripción
            $table->text('description')->nullable(); // Descripción del plan

            // Información de la transacción
            $table->boolean('status')->default(0); // 0: transacción fallida, 1: transacción exitosa
            $table->timestamp('creation_date')->nullable(); // Fecha de la transacción

            // Campos adicionales en caso de error
            $table->string('error_description')->nullable(); // Descripción del error
            $table->string('error_code')->nullable(); // Código de error
            $table->string('request_id')->nullable(); // ID de la solicitud

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};