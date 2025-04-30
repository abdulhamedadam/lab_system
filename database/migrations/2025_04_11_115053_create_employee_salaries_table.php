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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('housing_allowance', 10, 2)->nullable();
            $table->decimal('transportation_allowance', 10, 2)->nullable();
            $table->decimal('other_allowances', 10, 2)->nullable();
            $table->decimal('total_salary', 10, 2)->nullable();
            $table->date('effective_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salaries');
    }
};
