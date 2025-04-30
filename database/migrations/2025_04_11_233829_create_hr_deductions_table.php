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
        Schema::create('hr_deductions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('emp_id')->nullable();
            $table->smallInteger('value')->default('0')->nullable();
            $table->string('date_deductions', 25)->nullable();
            $table->string('date_deductions_int', 25)->nullable();
            $table->tinyInteger('month')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('reason', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_deductions');
    }
};
