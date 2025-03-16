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
        Schema::create('tbl_external_tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_code')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('test_type')->nullable();
            $table->integer('sample_number')->nullable();
            $table->decimal('sample_cost',8,2)->nullable();
            $table->decimal('total_cost',8,2)->nullable();
            $table->integer('report_number')->nullable();
            $table->string('report_date')->nullable();
//            $table->integer('invoice_num')->nullable();
//            $table->string('invoice_date')->nullable();
            $table->text('notes')->nullable();
            $table->enum('discount_type',['p','v'])->nullable();
            $table->decimal('discount')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_external_tests');
    }
};
