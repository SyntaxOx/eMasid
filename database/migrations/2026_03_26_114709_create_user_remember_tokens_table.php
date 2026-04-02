<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_remember_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('token_hash', 64)->unique();
            $table->text('user_agent')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->dateTime('expires_at');
            $table->dateTime('last_used_at')->nullable();
            $table->dateTime('created_at')->useCurrent();

            $table->index('user_id', 'idx_user_id');
            $table->index('expires_at', 'idx_expires_at');

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_remember_tokens');
    }
};