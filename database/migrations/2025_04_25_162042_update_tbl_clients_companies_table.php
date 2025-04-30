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

            $table->dropColumn(['name', 'phone', 'email', 'address1', 'created_by', 'updated_by','balance','company_code']);
            $table->integer('company_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_clients_companies', function (Blueprint $table) {
            $table->integer('company_code')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->double('balance',8,2)->nullable();
            $table->string('email')->nullable();
            $table->string('address1')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dropColumn('company_id');
        });
    }
};
