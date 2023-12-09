<div>
    @if(!empty($labels))
        <div 
            x-data="{}" 
            x-init="
                const chart = new Chart(
                    document.getElementById('girth-measurements-history-graph'),
                    {
                        type: 'bar',
                        data: {
                            labels: $wire.labels,
                            datasets: [
                                {
                                    type: 'line',
                                    label: 'Borst',
                                    data: $wire.chestMeasurements,
                                    backgroundColor: '#4cc7e9',
                                    borderColor: '#4cc7e9',
                                },
                                {
                                    type: 'line',
                                    label: 'Taille',
                                    data: $wire.waistMeasurements,
                                    backgroundColor: '#4cce73',
                                    borderColor: '#4cce73',
                                },
                                {
                                    type: 'line',
                                    label: 'Heup',
                                    data: $wire.hipsMeasurements,
                                    backgroundColor: '#fcdd12',
                                    borderColor: '#fcdd12',
                                },
                                {
                                    type: 'line',
                                    label: 'Onderborst',
                                    data: $wire.underBreastMeasurements,
                                    backgroundColor: '#fc124c',
                                    borderColor: '#fc124c',
                                },
                                {
                                    type: 'line',
                                    label: 'Biceps',
                                    data: $wire.upperArmMeasurements,
                                    backgroundColor: '#007a9c',
                                    borderColor: '#007a9c',
                                },
                                {
                                    type: 'line',
                                    label: 'Dij',
                                    data: $wire.thighMeasurements,
                                    backgroundColor: '#24873f',
                                    borderColor: '#24873f',
                                },
                            ]
                        },
                        options: {
                            circumference: 180,
                            rotation: 270,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                        }
                    }
                );
            "
        >
            <div class="mx-auto min-h-[300px]">
                <canvas id="girth-measurements-history-graph"></canvas>
            </div>
        </div>
    @else
        <div class="flex flex-col items-center justify-center h-[300px]">
            <p class="text-gray-500">Nog geen meting</p>
        </div>
    @endif
</div>
