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
            $table->enum('type',['soil','concrete','roads','mechanic'])->nullable();
            $table->decimal('cost',8,2)->default(0.00)->nullable();
            $table->integer('sample_number')->nullable();
            $table->enum('status',['pending','received','test_progress','test_done','reports_progress','reports_done'])->default('pending')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_tests', function (Blueprint $table) {
            $table->dropColumn(['cost','month','year','updated_by','created_by','status','sample_number','type']);
        });
    }
};
