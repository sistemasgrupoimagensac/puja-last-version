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
        Schema::create('tipos_documento', function (Blueprint $table) {
            $table->id();
            $table->string('documento', 150);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('tipos_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 150);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_usuario_id')->constrained(table: 'tipos_usuario');
            $table->string('codigo_unico', 200)->unique()->nullable();
            $table->string('nombres', 200);
            $table->string('apellidos', 200);
            $table->string('email', 150);
            $table->string('password')->nullable();
            $table->string('google_id')->nullable();
            $table->foreignId('tipo_documento_id')->nullable()->constrained(table: 'tipos_documento');
            $table->string('numero_documento', 50)->nullable();
            $table->string('celular', 15)->nullable();
            $table->string('imagen', 250)->nullable();
            $table->smallInteger('estado')->default(1);
            $table->boolean('acepta_termino_condiciones');
            $table->boolean('acepta_confidencialidad');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('tipos_documento');
        Schema::dropIfExists('tipos_usuario');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
