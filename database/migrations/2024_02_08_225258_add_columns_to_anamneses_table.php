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
        Schema::table('anamneses', function (Blueprint $table) {
            $table->string('goal')->nullable();
            $table->string('medical_operations')->nullable();
            $table->string('fysical_complaints')->nullable();
            $table->string('profession')->nullable();
            $table->string('irregular_working_hours')->nullable();
            $table->string('fysical_exercise')->nullable();
            $table->string('hormonal_issues')->nullable();
            $table->string('breastfeeding')->nullable();
            $table->string('pregnant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anamneses', function (Blueprint $table) {
            $table->dropColumn('goal');
            $table->dropColumn('medical_operations');
            $table->dropColumn('fysical_complaints');
            $table->dropColumn('profession');
            $table->dropColumn('irregular_working_hours');
            $table->dropColumn('fysical_exercise');
            $table->dropColumn('hormonal_issues');
            $table->dropColumn('breastfeeding');
            $table->dropColumn('pregnant');
        });
    }
};
