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
        Schema::create('soil_hasa_compaction_test_details', function (Blueprint $table) {
            $table->id();
            $table->integer('hasa_compaction_test_id')->nullable();
            $table->integer('point')->nullable();
            $table->string('point_location')->nullable();
            $table->string('layer_number')->nullable();
            $table->string('can_number')->nullable();
            $table->decimal('wt_wet_soil_can',8,2)->default(0.00)->nullable();
            $table->decimal('wt_dry_soil_can',8,2)->default(0.00)->nullable();
            $table->decimal('wt_moisture',8,2)->default(0.00)->nullable();
            $table->decimal('wt_can',8,2)->default(0.00)->nullable();
            $table->decimal('wt_dry_soil',8,2)->default(0.00)->nullable();
            $table->decimal('moisture_content',8,2)->default(0.00)->nullable();
            $table->decimal('wt_wet_soil',8,2)->default(0.00)->nullable();
            $table->decimal('wt_bottle_sand_before',8,2)->default(0.00)->nullable();
            $table->decimal('wt_bottle_sand_after',8,2)->default(0.00)->nullable();
            $table->decimal('wt_sand_used',8,2)->default(0.00)->nullable();
            $table->decimal('wt_sand_cone',8,2)->default(0.00)->nullable();
            $table->decimal('wt_sand_fill_hole',8,2)->default(0.00)->nullable();
            $table->decimal('unit_wt_sand',8,2)->default(0.00)->nullable();
            $table->decimal('hole_volume',8,2)->default(0.00)->nullable();
            $table->decimal('wet_density',8,2)->default(0.00)->nullable();
            $table->decimal('dry_density',8,2)->default(0.00)->nullable();
            $table->decimal('max_dry_density',8,2)->default(0.00)->nullable();
            $table->decimal('compaction',8,2)->default(0.00)->nullable();
            $table->decimal('req_compaction',8,2)->default(0.00)->nullable();
            $table->enum('evaluation',['pass','failed'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soil_hasa_compaction_test_details');
    }
};
