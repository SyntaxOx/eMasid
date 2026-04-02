<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_status_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('changed_by');
            $table->enum('old_status', ['pending', 'active', 'suspended', 'deactivated']);
            $table->enum('new_status', ['pending', 'active', 'suspended', 'deactivated']);
            $table->string('reason', 255)->nullable();
            $table->dateTime('created_at')->useCurrent();

            $table->index('user_id', 'idx_user_id');

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('changed_by')->references('user_id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_status_history');
    }
};