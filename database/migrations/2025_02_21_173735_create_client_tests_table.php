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
        Schema::create('client_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->string('test_table')->nullable();
            $table->string('test_model')->nullable();
            $table->string('test_type')->nullable();
            $table->string('test_name')->nullable();
            $table->string('test_value')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_tests');
    }
};
