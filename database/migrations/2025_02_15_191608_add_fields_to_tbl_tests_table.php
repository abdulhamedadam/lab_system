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
            $table->integer('monamzig_id')->nullable();
            $table->string('authorized_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_tests', function (Blueprint $table) {
            $table->dropColumn(['monamzig_id','authorized_name']);
        });
    }
};
