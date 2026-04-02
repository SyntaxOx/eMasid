<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_security', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->tinyInteger('two_factor_enabled')->default(0);
            $table->string('two_factor_secret', 255)->nullable();
            $table->dateTime('two_factor_verified_at')->nullable();
            $table->unsignedTinyInteger('failed_login_attempts')->default(0);
            $table->dateTime('last_failed_at')->nullable();
            $table->dateTime('lockout_until')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_security');
    }
};