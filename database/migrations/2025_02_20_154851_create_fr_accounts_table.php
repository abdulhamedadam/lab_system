<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fr_accounts', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable();
            $table->bigInteger('code')->nullable();
            $table->bigInteger('level')->nullable();
            $table->string('account_num')->nullable();
            $table->string('account_type')->nullable();
            $table->text('description')->nullable();
            NestedSet::columns($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_accounts');
    }
};
