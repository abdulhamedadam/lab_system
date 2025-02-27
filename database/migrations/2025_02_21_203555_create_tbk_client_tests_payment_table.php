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
        Schema::create('tbk_client_tests_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('client_test_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->decimal('value',8,2)->nullable();
            $table->string('paid_date')->nullable();
            $table->enum('payment_type',['cash','bank','check'])->nullable();
            $table->text('notes')->nullable();
            $table->integer('received_by')->nullable();
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
        Schema::dropIfExists('tbk_client_tests_payment');
    }
};
