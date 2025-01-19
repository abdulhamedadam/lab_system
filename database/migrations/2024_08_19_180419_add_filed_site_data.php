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
        Schema::table('site_data', function (Blueprint $table) {
            $table->string('tax_number',100)->nullable();
            $table->string('commercial_registration_number',100)->nullable();
            $table->text('contract_terms')->nullable();
            $table->string('image_print', 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_data', function (Blueprint $table) {
            $table->removeColumn('contract_terms');
            $table->removeColumn('commercial_registration_number');
            $table->removeColumn('tax_number');
            $table->removeColumn('image_print');
        });
    }
};
