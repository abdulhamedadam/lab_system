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
        Schema::create('fr_sand_sarf', function (Blueprint $table) {
            $table->id();
            $table->string('num')->nullable();
            $table->string('date_at')->nullable();
            $table->integer('from_account')->nullable();
            $table->integer('to_account')->nullable();
            $table->decimal('amount')->nullable();
            $table->text('create_by')->nullable();
            $table->text('notes')->nullable();
            $table->integer('entries_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fr_sand_sarf');
    }
};
