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
            $table->enum('sub_test_type',['compaction','proctor','cbr','plasticity','salt_gypsum','salt_organic','shear','unconfined_compression','gradual']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_tests', function (Blueprint $table) {
            $table->dropColumn(['sub_test_type']);
        });
    }
};
