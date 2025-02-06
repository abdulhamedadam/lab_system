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
        Schema::create('tbl_soil_compaction_test', function (Blueprint $table) {
            $table->id();
            $table->integer('soil_test_id')->nullable();
            $table->string('test_carried_date')->nullable();
            $table->string('proctor_test_date')->nullable();
            $table->string('sample_collect_date')->nullable();
            $table->string('location')->nullable();
            $table->string('proctor_ref')->nullable();
            $table->string('test_method')->nullable();
            $table->string('material_desc')->nullable();
            $table->string('mold_number')->nullable();
            $table->decimal('mdd',8,2)->nullable();
            $table->decimal('moc',8,2)->nullable();
            $table->decimal('diameter',8,2)->nullable();
            $table->decimal('height',8,2)->nullable();
            $table->decimal('volume',8,2)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_soil_compaction_test');
    }
};
