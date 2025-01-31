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
        Schema::create('tbl_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('company_id');
            $table->integer('project_id');
            $table->string('test_code');
            $table->string('talab_number');
            $table->string('talab_title');
            $table->string('talab_image')->nullable();
            $table->date('talab_date');
            $table->date('talab_end_date');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

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
