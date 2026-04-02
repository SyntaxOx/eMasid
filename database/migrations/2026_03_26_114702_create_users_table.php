<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('resident_id')->unique();
            $table->unsignedInteger('brgy_id');
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('suffix', 10)->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->string('full_address', 255);
            $table->string('mobile_number', 15)->unique();
            $table->string('email', 191)->unique();
            $table->string('password_hash', 255);
            $table->dateTime('last_password_changed')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->tinyInteger('is_verified')->default(0);
            $table->dateTime('verified_at')->nullable();
            $table->enum('status', ['pending', 'active', 'suspended', 'deactivated'])->default('pending');
            $table->tinyInteger('restricted_access')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('brgy_id', 'idx_brgy_id');
            $table->index('email', 'idx_email');
            $table->index('status', 'idx_status');
            $table->index('is_verified', 'idx_is_verified');
            $table->index('restricted_access', 'idx_restricted_access');
            $table->index('deleted_at', 'idx_deleted_at');

            $table->foreign('brgy_id')->references('brgy_id')->on('barangay');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};