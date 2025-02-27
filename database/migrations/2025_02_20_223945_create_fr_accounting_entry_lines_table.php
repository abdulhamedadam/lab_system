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
        Schema::create('fr_accounting_entry_lines', function (Blueprint $table) {
            $table->id();
            $table->integer('accounting_entry_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->decimal('amount')->nullable();
            $table->enum('type', ['debtor', 'creditor'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_accounting_entry_lines');
    }
};
