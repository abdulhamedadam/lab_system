<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbl_tests', function (Blueprint $table) {
            $table->integer('sader_number')->nullable();
            $table->date('sader_date')->nullable();
            $table->integer('sader_year')->virtualAs('YEAR(sader_date)'); // Virtual column to store year
            $table->unique(['sader_number', 'sader_year'], 'unique_sader_per_year');
            $table->string('test_code_st')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_tests', function (Blueprint $table) {
            $table->dropColumn(['sader_number','sader_date','test_code_st','sader_year']);
        });
    }
};
