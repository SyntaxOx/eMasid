<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->enum('document_type', [
                'barangay_cert',
                'utility_bill',
                'voters_id',
                'postal_id',
                'bank_statement',
                'lease_contract',
                'other',
            ]);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedInteger('reviewed_by')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->string('rejection_reason', 255)->nullable();
            $table->timestamps();

            $table->index('user_id', 'idx_user_id');
            $table->index('status', 'idx_status');

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_verifications');
    }
};