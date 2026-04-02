<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangay', function (Blueprint $table) {
            $table->increments('brgy_id');
            $table->string('brgy_name', 100);
            $table->string('municipality', 100);
            $table->string('province', 100);
            $table->string('region', 100)->nullable();
            $table->string('zip_code', 10)->nullable();

            $table->unique(['brgy_name', 'municipality', 'province'], 'uq_barangay');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangay');
    }
};