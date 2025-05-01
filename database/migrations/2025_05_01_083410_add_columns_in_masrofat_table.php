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
        Schema::table('tbl_masrofat', function (Blueprint $table) {
            $table->date('sarf_date')->after('notes')->default(now());
            $table->text('sarf_details')->after('sarf_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_masrofat', function (Blueprint $table) {
            $table->dropColumn('sarf_date');
            $table->dropColumn('sarf_details');
        });
    }
};
