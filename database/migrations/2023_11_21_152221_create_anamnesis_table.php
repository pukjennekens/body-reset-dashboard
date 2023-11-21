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
        Schema::create('anamnesis', function (Blueprint $table) {
            $table->id();

            $table->string('gastrointestinal_issues')->nullable();                   // Maag- of darmklachten
            $table->string('kidney_or_liver_problems')->nullable();                  // Nier- of leverproblemen
            $table->string('back_shoulder_joint_issues')->nullable();                // Rug, schouder of gewrichtsklachten
            $table->string('medications_or_supplements')->nullable();                // Medicijnen of supplementen
            $table->boolean('diabetes')->nullable();                                 // Diabetes (Ja/Nee)
            $table->boolean('gout')->nullable();                                     // Jicht (Ja/Nee)
            $table->boolean('epilepsy')->nullable();                                 // Epilepsie (Ja/Nee)
            $table->boolean('cancer')->nullable();                                   // Kanker (Ja/Nee)
            $table->boolean('hypokalemia')->nullable();                              // Hypokaliemie (Ja/Nee)
            $table->string('prostheses_pacemaker_implants')->nullable();             // Prothesen, pacemaker of implantaten
            $table->boolean('electro_cardiograph_or_other_instruments')->nullable(); // Electro-cardiograph of andere medische instrumenten (Ja/Nee)
            $table->boolean('varicose_veins')->nullable();                           // Spataderen (Ja/Nee)
            $table->boolean('arrhythmia')->nullable();                               // Hartritmestorenissen (Ja/Nee)
            $table->string('skin_conditions')->nullable();                           // Huidziekten
            $table->boolean('recent_heart_attack')->nullable();                      // Recent hartinfarct
            $table->boolean('regular_muscle_cramps')->nullable();                    // Regelmatig spierkrampen
            $table->string('anti_depressants')->nullable();                          // Anti-deperessiva

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamnesis');
    }
};
