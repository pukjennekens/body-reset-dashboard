<div>
    <div 
        x-data="{}" 
        x-init="
            const chart = new Chart(
                document.getElementById('body-composition-history-graph'),
                {
                    type: 'bar',
                    data: {
                        labels: $wire.labels,
                        datasets: [
                            {
                                type: 'bar',
                                label: 'Vetpercentage',
                                data: $wire.fatMassMeasurements,
                                backgroundColor: '#00ba38'
                            },
                            {
                                type: 'bar',
                                label: 'Botmassa',
                                data: $wire.boneMassMeasurements,
                                backgroundColor: '#e1e3e1'
                            },
                            {
                                type: 'bar',
                                label: 'Spiermassa',
                                data: $wire.muscleMassMeasurements,
                                backgroundColor: '#4cc7e9'
                            },
                            {
                                type: 'line',
                                label: 'Vochtpercentage',
                                data: $wire.waterPercentageMeasurements,
                                backgroundColor: '#0c4cb3',
                                borderColor: '#0c4cb3',
                                yAxisID: 'y-axis-1',
                                order: -1,
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
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                stacked: true,
                            },
                            y: {
                                stacked: true
                            }
                        }
                    }
                }
            );
        "
    >
        <div class="mx-auto min-h-[300px]">
            <canvas id="body-composition-history-graph"></canvas>
        </div>
    </div>
</div>
