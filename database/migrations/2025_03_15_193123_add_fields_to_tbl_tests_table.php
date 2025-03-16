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
            $table->decimal('sample_cost',8,2)->nullable();
            $table->decimal('total_cost',8,2)->nullable();
            $table->enum('discount_type',['p','v'])->nullable();
            $table->decimal('discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_tests', function (Blueprint $table) {
            $table->dropColumn(['sample_cost','total_cost','discount_type','discount']);
        });
    }
};
