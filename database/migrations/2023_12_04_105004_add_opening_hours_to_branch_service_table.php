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
        Schema::table('branch_service', function (Blueprint $table) {
            $table->json('opening_hours_monday')->nullable();
            $table->json('opening_hours_tuesday')->nullable();
            $table->json('opening_hours_wednesday')->nullable();
            $table->json('opening_hours_thursday')->nullable();
            $table->json('opening_hours_friday')->nullable();
            $table->json('opening_hours_saturday')->nullable();
            $table->json('opening_hours_sunday')->nullable();
            $table->json('opening_hours_holiday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branch_service', function (Blueprint $table) {
            $table->dropColumn('opening_hours_monday');
            $table->dropColumn('opening_hours_tuesday');
            $table->dropColumn('opening_hours_wednesday');
            $table->dropColumn('opening_hours_thursday');
            $table->dropColumn('opening_hours_friday');
            $table->dropColumn('opening_hours_saturday');
            $table->dropColumn('opening_hours_sunday');
            $table->dropColumn('opening_hours_holiday');
        });
    }
};
