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
        Schema::create('site_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image', 255)->nullable();
            $table->text('name')->nullable();
            $table->string('email', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('description')->nullable();
            $table->text('maplocation')->nullable();
            $table->text('short_about')->nullable();
            $table->text('video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_data');
    }
};
