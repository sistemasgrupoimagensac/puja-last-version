<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProjectSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('user_project_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('project_plan_id')->constrained('project_plans')->onDelete('cascade');
            $table->string('customer_id');
            $table->string('card_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_project_subscriptions');
    }
}

