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
        Schema::table('tbk_client_tests_payment', function (Blueprint $table) {
            $table->integer('num')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbk_client_tests_payment', function (Blueprint $table) {
            $table->dropColumn(['num']);
        });
    }
};
