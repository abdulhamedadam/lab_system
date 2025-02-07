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
        Schema::table('tbl_tests', function (Blueprint $table) {
            $table->integer('wared_number')->nullable();
            $table->integer('book_number')->nullable();
            $table->enum('test_type',['soil','hasa'])->default('soil')->nullable();
            $table->string('wared_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_tests', function (Blueprint $table) {
            //
        });
    }
};
