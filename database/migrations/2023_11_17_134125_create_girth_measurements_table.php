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
        Schema::create('girth_measurements', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('chest');
            $table->float('hips');
            $table->float('thigh');
            $table->float('under_breast');
            $table->float('upper_arm');
            $table->float('waist');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('girth_measurements');
    }
};
