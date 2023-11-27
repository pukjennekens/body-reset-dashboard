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
        Schema::create('nutrition_plans', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('creator_user_id')->constrained('users')->cascadeOnDelete();
            $table->longText('remark')->nullable();
            $table->longText('remark_internal')->nullable();

            $table->longText('remark_monday')->nullable();
            $table->longText('remark_tuesday')->nullable();
            $table->longText('remark_wednesday')->nullable();
            $table->longText('remark_thursday')->nullable();
            $table->longText('remark_friday')->nullable();
            $table->longText('remark_saturday')->nullable();
            $table->longText('remark_sunday')->nullable();

            $table->json('recipies_monday')->nullable();
            $table->json('recipies_tuesday')->nullable();
            $table->json('recipies_wednesday')->nullable();
            $table->json('recipies_thursday')->nullable();
            $table->json('recipies_friday')->nullable();
            $table->json('recipies_saturday')->nullable();
            $table->json('recipies_sunday')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_plans');
    }
};
