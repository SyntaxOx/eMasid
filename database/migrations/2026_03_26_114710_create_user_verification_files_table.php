<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_verification_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('verification_id');
            $table->string('file_path', 500);
            $table->string('original_name', 255);
            $table->enum('file_type', ['image', 'pdf']);
            $table->unsignedInteger('file_size');
            $table->dateTime('created_at')->useCurrent();

            $table->index('verification_id', 'idx_verification_id');

            $table->foreign('verification_id')->references('id')->on('user_verifications')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_verification_files');
    }
};