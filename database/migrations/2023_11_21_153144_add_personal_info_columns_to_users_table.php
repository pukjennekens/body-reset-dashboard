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
        Schema::table('users', function (Blueprint $table) {
            $table->date('birth_date')->nullable();
            $table->enum('language', ['nl', 'en', 'fr'])->default('nl');
            $table->string('phone_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('house_number')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->enum('country', ['nl', 'be'])->default('be');
            $table->string('province')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn([
                'birth_date',
                'language',
                'phone_number',
                'street_name',
                'house_number',
                'postal_code',
                'city',
                'country',
                'province',
            ]);
        });
    }
};
