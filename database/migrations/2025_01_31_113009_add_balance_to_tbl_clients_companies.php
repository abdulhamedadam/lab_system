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
        Schema::table('tbl_clients_companies', function (Blueprint $table) {
            $table->double('balance', 8, 2)->default(0.00)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_clients_companies', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
};
