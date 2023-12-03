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
        Schema::create('anamneses', function (Blueprint $table) {
            $table->id();

            $table->string('gastrointestinal_issues')->nullable();                   // Maag- of darmklachten (gastrointestinal_issues)
            $table->string('kidney_or_liver_problems')->nullable();                  // Nier- of leverproblemen (kidney_or_liver_problems)
            $table->string('back_shoulder_joint_issues')->nullable();                // Rug, schouder of gewrichtsklachten (back_shoulder_joint_issues)
            $table->string('prostheses_pacemaker_implants')->nullable();             // Prothesen, pacemaker of implantaten (prostheses_pacemaker_implants)
            $table->string('skin_conditions')->nullable();                           // Huidziekten (skin_conditions)
            $table->string('anti_depressants')->nullable();                          // Anti-deperessiva (anti_depressants)
            $table->string('medications_or_supplements')->nullable();                // Medicijnen of supplementen (medications_or_supplements)
            $table->boolean('electro_cardiograph_or_other_instruments')->nullable(); // Electro-cardiograph of andere medische instrumenten (Ja/Nee) (electro_cardiograph_or_other_instruments)
            $table->boolean('varicose_veins')->nullable();                           // Spataderen (Ja/Nee) (varicose_veins)
            $table->boolean('arrhythmia')->nullable();                               // Hartritmestorenissen (Ja/Nee) (arrhythmia)
            $table->boolean('recent_heart_attack')->nullable();                      // Recent hartinfarct (recent_heart_attack)
            $table->boolean('regular_muscle_cramps')->nullable();                    // Regelmatig spierkrampen (regular_muscle_cramps)
            $table->boolean('diabetes')->nullable();                                 // Diabetes (Ja/Nee) (diabetes)
            $table->boolean('gout')->nullable();                                     // Jicht (Ja/Nee) (gout)
            $table->boolean('epilepsy')->nullable();                                 // Epilepsie (Ja/Nee) (epilepsy)
            $table->boolean('cancer')->nullable();                                   // Kanker (Ja/Nee) (cancer)
            $table->boolean('hypokalemia')->nullable();                              // Hypokaliemie (Ja/Nee) (hypokalemia)

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
