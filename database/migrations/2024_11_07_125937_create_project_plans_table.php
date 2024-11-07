<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPlansTable extends Migration
{
    public function up()
    {
        Schema::create('project_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('duration_in_months');
            $table->string('status_after_retry')->default('cancelled');
            $table->integer('retry_times')->default(2);
            $table->string('currency')->default('PEN');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_plans');
    }
}
