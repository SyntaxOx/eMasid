<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otp_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->enum('purpose', ['email_verify', 'phone_verify', 'password_reset', 'login_2fa']);
            $table->string('code_hash', 255);
            $table->enum('channel', ['email', 'sms'])->default('email');
            $table->dateTime('expires_at');
            $table->dateTime('used_at')->nullable();
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->dateTime('created_at')->useCurrent();

            $table->index('user_id', 'idx_user_id');
            $table->index('purpose', 'idx_purpose');
            $table->index('expires_at', 'idx_expires');

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otp_codes');
    }
};