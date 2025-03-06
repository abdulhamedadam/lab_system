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
        Schema::create('tbl_concrete_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('test_code')->nullable();
            $table->integer('talab_number')->nullable();
            $table->string('talab_title')->nullable();
            $table->string('talab_image')->nullable();
            $table->string('talab_image')->nullable();
            $table->string('talab_date')->nullable();
            $table->string('talab_end_date')->nullable();
            $table->decimal('cost',8,2)->nullable();
            $table->integer('sample_number')->nullable();
            $table->status('sample_number')->nullable();
            $table->integer('monamzig_id')->nullable();
            $table->string('authorized_name')->nullable();
            $table->enum('status',['pending','received','test_progress','test_done','reports_progress','reports_done'])->default('pending')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('wared_number')->nullable();
            $table->integer('book_number')->nullable();
            $table->string('test_type')->nullable();
            $table->string('sub_test_type')->nullable();
            $table->string('wared_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_concrete_tests');
    }
};
