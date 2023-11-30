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
        Schema::create('credit_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('credit_option_id')->constrained();
            $table->string('payment_method')->nullable();
            $table->enum('status', ['open', 'canceled', 'pending', 'authorized', 'expired', 'failed', 'paid'])->nullable();
            $table->string('order_description')->nullable();
            $table->string('currency')->nullable();
            $table->float('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_orders');
    }
};
