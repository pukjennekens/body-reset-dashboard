<div>
    <div 
        x-data="{}" 
        x-init="
            const chart = new Chart(
                document.getElementById('weight-distribution-graph'),
                {
                    type: 'doughnut',
                    data: {
                        labels: [
                            'Vetpercentage',
                            'Botmassa',
                            'Spiermassa',
                        ],
                        datasets: [
                            {
                                label: 'Gewichtsverdeling',
                                data: [
                                    $wire.measurement.fat_percentage,
                                    $wire.measurement.bone_mass,
                                    $wire.measurement.muscle_mass,
                                ],
                                backgroundColor: [
                                    '#00ba38',
                                    '#e1e3e1',
                                    '#4cc7e9'
                                ],
                            }
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
                        // Change the height
                        responsive: true,
                        maintainAspectRatio: false,
                    }
                }
            );
        "
    >
        <div class="max-h-36 mx-auto">
            <canvas id="weight-distribution-graph"></canvas>
        </div>
    </div>
</div>
