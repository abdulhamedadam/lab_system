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
        Schema::create('tbl_soil_compaction_test_details', function (Blueprint $table) {
            $table->id();
            $table->integer('soil_compaction_test_id')->nullable();
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
            $table->decimal('wt_wet_soil_gm',8,2)->default(0.00)->nullable();
            $table->decimal('mulod_volume',8,2)->default(0.00)->nullable();
            $table->decimal('wet_density',8,2)->default(0.00)->nullable();
            $table->decimal('dry_density',8,2)->default(0.00)->nullable();
            $table->decimal('max_dry_density',8,2)->default(0.00)->nullable();
            $table->decimal('compaction',8,2)->default(0.00)->nullable();
            $table->decimal('req_compaction',8,2)->default(0.00)->nullable();
            $table->enum('evaluation',[0,1])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_soil_compaction_test_details');
    }
};
