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
        Schema::create('hr_loans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('emp_id')->unsigned()->nullable();
            $table->enum('loan_type',array('advance payment','loan'))->nullable();
            $table->smallInteger('value')->default('0')->nullable();
            $table->tinyInteger('installments_num')->default('1')->nullable();
            $table->string('date_loan', 25)->nullable();
            $table->string('date_loan_int', 25)->nullable();
            $table->string('reason', 255)->nullable();
            $table->enum('status', array('accept', 'refuse', 'pending', 'ended'))->default('pending')->nullable();
            $table->tinyInteger('month')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('date_deductions', 25)->nullable();
            $table->string('date_deductions_int', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hr_loans');
    }
};
