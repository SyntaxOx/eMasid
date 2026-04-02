<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_login_logs', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('identifier', 191);
            $table->dateTime('login_at')->useCurrent();
            $table->dateTime('logout_at')->nullable();
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->enum('status', ['success', 'failed', 'locked']);
            $table->string('failure_reason', 100)->nullable();
            $table->string('session_token', 255)->nullable();
            $table->string('location', 100)->nullable();
            $table->tinyInteger('via_remember_me')->default(0);

            $table->index('user_id', 'idx_user_id');
            $table->index('identifier', 'idx_identifier');
            $table->index('login_at', 'idx_login_at');
            $table->index('status', 'idx_status');

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_login_logs');
    }
};