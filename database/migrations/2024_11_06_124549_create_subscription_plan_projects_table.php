<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlanProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plan_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_cliente_id');
            $table->string('subscription_id')->unique();  // ID de la suscripción en Openpay
            $table->string('status')->default('active');  // Estado de la suscripción (active, cancelled, etc.)
            $table->date('start_date')->nullable();       // Fecha de inicio de la suscripción
            $table->date('end_date')->nullable();         // Fecha de finalización de la suscripción
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('proyecto_cliente_id')->references('id')->on('proyecto_clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plan_projects');
    }
}
