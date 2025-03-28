document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded with JavaScript');
    energyUsageTracker();
    carbonFootprintCalculator();
    scheduleForm();
});

// Energy Usage Tracker
function energyUsageTracker() {
    if (document.getElementById('energy-usage-chart') === null) {
        return;
    }
    // Grab energy usage data from local storage
    let energyUsageData = localStorage.getItem('energyUsageData');

    // energyUsageData is currently looks like this
    // energyUsageData = [
    //     {
    //         date: '2021-09-01',
    //         energyUsage: 65
    //     },
    //     {
    //         date: '2021-09-02',
    //         energyUsage: 59
    //     },
    //     ...
    // ]
    

    // we create two arrays so that we can pass extract the data from energyUsageData
    let energyUsageDates = [];
    let energyUsageValues = [];
    
    // If energyUsageData is not empty, then search for the data
    if (energyUsageData) {
        energyUsageData = JSON.parse(energyUsageData);
        energyUsageData.forEach(function(data) {
            energyUsageDates.push(data.date);
            energyUsageValues.push(data.energyUsage);
        });
    }

    let chartColors = {
        textColor: '#fff', 
        gridColor: 'rgba(255, 255, 255, 0.2)',
        borderColor: '#FFFFFF', 
        backgroundColor: 'rgba(255, 255, 255, 0.1)', 
        lineColor: '#FFFFFF' 
    };

    // Create the chart
    const energyUsageChart = new Chart("energy-usage-chart", {
        type: 'line',
        data: {
            labels: energyUsageDates,
            datasets: [{
                label: 'Energy Usage',
                data: energyUsageValues,
                borderColor: chartColors.lineColor,
                backgroundColor: chartColors.backgroundColor,
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: chartColors.textColor
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: chartColors.gridColor 
                    },
                    ticks: {
                        color: chartColors.textColor
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: chartColors.gridColor 
                    },
                    ticks: {
                        color: chartColors.textColor
                    }
                }
            }
        }
    });
}
// Carbon Footprint Calculator
function carbonFootprintCalculator() {
    if (document.getElementById('emissions-chart') === null) {
        return;
    }
    // Grab carbon footprint data from local storage
    let carbonFootprintData = localStorage.getItem('carbonFootprintData');

    // carbonFootprintData is currently looks like this
    // carbonFootprintData = [
    //     {
    //         date: '2021-09-01',
    //         emissions: 0.65
    //     },
    //     {
    //         date: '2021-09-02',
    //         emissions: 0.59
    //     },
    //     ...
    // ]
    

    // we create two arrays so that we can pass extract the data from carbonFootprintData
    let carbonFootprintDates = [];
    let carbonFootprintValues = [];
    
    // If carbonFootprintData is not empty, then search for the data
    if (carbonFootprintData) {
        carbonFootprintData = JSON.parse(carbonFootprintData);
        carbonFootprintData.forEach(function(data) {
            carbonFootprintDates.push(data.date);
            carbonFootprintValues.push(data.emissions);
        });
    }

    let chartColors = {
        textColor: '#fff', // 
        gridColor: 'rgba(255, 255, 255, 0.2)', 
        borderColor: '#FFFFFF', 
        backgroundColor: 'rgba(255, 255, 255, 0.1)', 
        lineColor: '#FFFFFF' 
    };

    // Create the chart
    const carbonFootprintChart = new Chart("emissions-chart", {
        type: 'line',
        data: {
            labels: carbonFootprintDates,
            datasets: [{
                label: 'Carbon Footprint',
                data: carbonFootprintValues,
                borderColor: chartColors.lineColor,
                backgroundColor: chartColors.backgroundColor
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: chartColors.textColor
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: chartColors.gridColor 
                    },
                    ticks: {
                        color: chartColors.textColor
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: chartColors.gridColor 
                    },
                    ticks: {
                        color: chartColors.textColor
                    }
                }
            }
        }
    });
}

// Schedule Form
function scheduleForm() {
    if (document.getElementById('appointment-type') === null) {
        return;
    }
    document.getElementById('appointment-type').addEventListener('change', function() {
        const consultationQuestions = document.getElementById('consultation-questions');
        const installationQuestions = document.getElementById('installation-questions');

        if (this.value === 'consultation') {
            consultationQuestions.style.display = 'block';
            installationQuestions.style.display = 'none';
        } else if (this.value === 'installation') {
            consultationQuestions.style.display = 'none';
            installationQuestions.style.display = 'block';
        } else {
            consultationQuestions.style.display = 'none';
            installationQuestions.style.display = 'none';
        }
    });
}