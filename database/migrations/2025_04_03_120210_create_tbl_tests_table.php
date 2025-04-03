<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('sader_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('test_code')->nullable();
            $table->string('test_code_st')->nullable();
            $table->string('talab_number')->nullable();
            $table->string('talab_title')->nullable();
            $table->string('talab_image')->nullable();
            $table->date('talab_date')->nullable();
            $table->date('talab_end_date')->nullable();
            $table->integer('wared_number')->nullable();
            $table->string('wared_date')->nullable();
            $table->integer('book_number')->nullable();
            $table->enum('test_type',['soil','hasa'])->default('soil')->nullable();
            $table->decimal('sample_cost', 8, 2)->nullable();
            $table->enum('discount_type', ['p', 'v'])->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('cost', 8, 2)->default(0.00)->nullable();
            $table->decimal('total_cost', 8, 2)->nullable();
            $table->enum('test_type', ['soil', 'concrete', 'roads', 'mechanic'])->nullable();
            $table->enum('type', ['external', 'system'])->nullable();
            $table->string('sub_test_type')->nullable();
            $table->enum('status', ['pending', 'received', 'test_progress', 'test_done', 'reports_progress', 'reports_done'])->default('pending')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('monamzig_id')->nullable();
            $table->string('authorized_name')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tests');
    }
};
