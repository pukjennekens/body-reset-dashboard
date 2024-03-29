<form action="" wire:submit="createAnamnesis" class="space-y-8">
    <div>
        <x-input.text name="form.goal" label="Doel" value="{{ old('form.goal', $anamnesis ? $anamnesis->goal : '') }}" />
    </div>

    <div>
        <h2 class="text-xl font-bold mb-2">Algemeen</h2>

        <div class="grid grid-cols-2 gap-4">
            <x-input.text name="form.gastrointestinal_issues" label="Maag- of darmklachten" value="{{ old('form.gastrointestinal_issues', $anamnesis ? $anamnesis->gastrointestinal_issues : '') }}" />
            <x-input.text name="form.kidney_or_liver_problems" label="Nier- of leverproblemen" value="{{ old('form.kidney_or_liver_problems', $anamnesis ? $anamnesis->kidney_or_liver_problems : '') }}" />
            <x-input.text name="form.back_shoulder_joint_issues" label="Rug, schouder of gewrichtsklachten" value="{{ old('form.back_shoulder_joint_issues', $anamnesis ? $anamnesis->back_shoulder_joint_issues : '') }}" />
            <x-input.text name="form.prostheses_pacemaker_implants" label="Prothesen, pacemaker of implantaten" value="{{ old('form.prostheses_pacemaker_implants', $anamnesis ? $anamnesis->prostheses_pacemaker_implants : '') }}" />
            <x-input.text name="form.skin_conditions" label="Huidziekten" value="{{ old('form.skin_conditions', $anamnesis ? $anamnesis->skin_conditions : '') }}" />
            <x-input.text name="form.anti_depressants" label="Anti-deperessiva" value="{{ old('form.anti_depressants', $anamnesis ? $anamnesis->anti_depressants : '') }}" />
            <x-input.text name="form.medications_or_supplements" label="Medicijnen of supplementen" value="{{ old('form.medications_or_supplements', $anamnesis ? $anamnesis->medications_or_supplements : '') }}" />
            <x-input.text name="form.medical_operations" label="Medische operaties" value="{{ old('form.medical_operations', $anamnesis ? $anamnesis->medical_operations : '') }}" />
            <x-input.text name="form.fysical_complaints" label="Fysieke klachten" value="{{ old('form.fysical_complaints', $anamnesis ? $anamnesis->fysical_complaints : '') }}" />
            <x-input.text name="form.profession" label="Beroep" value="{{ old('form.profession', $anamnesis ? $anamnesis->profession : '') }}" />
            <x-input.text name="form.irregular_working_hours" label="Onregelmatige werktijden" value="{{ old('form.irregular_working_hours', $anamnesis ? $anamnesis->irregular_working_hours : '') }}" />
            <x-input.text name="form.fysical_exercise" label="Fysieke inspanning" value="{{ old('form.fysical_exercise', $anamnesis ? $anamnesis->fysical_exercise : '') }}" />
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <label for="electro_cardiograph_or_other_instruments">
            <input type="checkbox" id="electro_cardiograph_or_other_instruments" wire:model.fill="form.electro_cardiograph_or_other_instruments" @if(old('form.electro_cardiograph_or_other_instruments', $anamnesis ? $anamnesis->electro_cardiograph_or_other_instruments : false)) checked @endif />
            <span>Electro-cardiograph of andere medische instrumenten</span>
        </label>
        <label for="varicose_veins">
            <input type="checkbox" id="varicose_veins" wire:model.fill="form.varicose_veins" @if(old('form.varicose_veins', $anamnesis ? $anamnesis->varicose_veins : false)) checked @endif />
            <span>Spataderen</span>
        </label>
        <label for="arrhythmia">
            <input type="checkbox" id="arrhythmia" wire:model.fill="form.arrhythmia" @if(old('form.arrhythmia', $anamnesis ? $anamnesis->arrhythmia : false)) checked @endif />
            <span>Hartritmestorenissen</span>
        </label>
        <label for="recent_heart_attack">
            <input type="checkbox" id="recent_heart_attack" wire:model.fill="form.recent_heart_attack" @if(old('form.recent_heart_attack', $anamnesis ? $anamnesis->recent_heart_attack : false)) checked @endif />
            <span>Recent hartinfarct</span>
        </label>
        <label for="regular_muscle_cramps">
            <input type="checkbox" id="regular_muscle_cramps" wire:model.fill="form.regular_muscle_cramps" @if(old('form.regular_muscle_cramps', $anamnesis ? $anamnesis->regular_muscle_cramps : false)) checked @endif />
            <span>Regelmatig spierkrampen</span>
        </label>
        <label for="diabetes">
            <input type="checkbox" id="diabetes" wire:model.fill="form.diabetes" @if(old('form.diabetes', $anamnesis ? $anamnesis->diabetes : false)) checked @endif />
            <span>Diabetes</span>
        </label>
        <label for="gout">
            <input type="checkbox" id="gout" wire:model.fill="form.gout" @if(old('form.gout', $anamnesis ? $anamnesis->gout : false)) checked @endif />
            <span>Jicht</span>
        </label>
        <label for="epilepsy">
            <input type="checkbox" id="epilepsy" wire:model.fill="form.epilepsy" @if(old('form.epilepsy', $anamnesis ? $anamnesis->epilepsy : false)) checked @endif />
            <span>Epilepsie</span>
        </label>
        <label for="cancer">
            <input type="checkbox" id="cancer" wire:model.fill="form.cancer" @if(old('form.cancer', $anamnesis ? $anamnesis->cancer : false)) checked @endif />
            <span>Kanker</span>
        </label>
        <label for="hypokalemia">
            <input type="checkbox" id="hypokalemia" wire:model.fill="form.hypokalemia" @if(old('form.hypokalemia', $anamnesis ? $anamnesis->hypokalemia : false)) checked @endif />
            <span>Hypokaliemie</span>
        </label>
    </div>

    <div>
        <h2 class="text-xl font-bold mb-2">Vrouwen</h2>

        <div class="grid grid-cols-2 gap-4">
            <x-input.text name="form.hormonal_issues" label="Hormonale klachten" value="{{ old('form.hormonal_issues', $anamnesis ? $anamnesis->hormonal_issues : '') }}" />
            <x-input.text name="form.breastfeeding" label="Borstvoeding" value="{{ old('form.breastfeeding', $anamnesis ? $anamnesis->breastfeeding : '') }}" />
            <x-input.text name="form.pregnant" label="Zwanger" value="{{ old('form.pregnant', $anamnesis ? $anamnesis->pregnant : '') }}" />
        </div>
    </div>

    <x-input.button type="submit">
        Opslaan

        <i class="fa-solid fa-spinner fa-spin ml-2" wire:loading wire:target="createAnamnesis"></i>

        @if($anamnesisSaved)
            <i class="fa-solid fa-check ml-2" wire:loading.remove wire:target="createAnamnesis"></i>
        @endif
    </x-input.button>
</form>
