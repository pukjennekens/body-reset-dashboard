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
        Schema::create('body_composition_measurements', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('height');
            $table->float('weight');
            $table->float('bone_mass');
            $table->float('muscle_mass');
            $table->float('fat_percentage');
            $table->float('water_percentage');
            $table->integer('metabolic_age');
            $table->float('visceral_fat');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('body_composition_measurements');
    }
};
