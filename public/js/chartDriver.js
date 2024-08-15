
// Chart MPU
var mpuMaxData = 20;
var mpuChartCanvas = $('#mpu-canvas').get(0).getContext('2d');
var knobX = $('.knob-x');
var knobY = $('.knob-y');
var knobZ = $('.knob-z');

var mpuChartData = {
    labels: [
         
    ],
    datasets: [
        {
            label: 'Sudut X',
            'fill': false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#39cc39',
            pointBackgroundColor: '#39cc39',
            data: [ ] 
        }, {
            label: 'Sudut Y',
            'fill': false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#39cccc',
            pointBackgroundColor: '#39cccc',
            data: [ ] 
        }, {
            label: 'Sudut Z',
            'fill': false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#cc39cc',
            pointBackgroundColor: '#cc39cc',
            data: [] 
        }
    ]
}

var mpuChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
        display: true
    },
    // interaction: {
    //     mode: 'index',
    //     intersect: false,
    // },
    scales: {
        xAxes: [{
            ticks: {
                fontColor: '#efefef'
            },
            gridLines: {
                display: false,
                color: '#efefef',
                drawBorder: false
            }
        }],
        yAxes: [{
            ticks: {
            stepSize: 1000,
                fontColor: '#efefef'
            },
            gridLines: {
                display: true,
                color: '#efefef',
                drawBorder: false
            }
        }]
    }
} 

var mpuGraphChart = new Chart(
    mpuChartCanvas,
    {
        type: 'line',
        data: mpuChartData,
        options: mpuChartOptions
    })

function addDataMPU({x, y, z}){
    if(mpuChartData.labels.length>=mpuMaxData){
        mpuChartData.labels.shift();
        mpuChartData.datasets[0].data.shift();
        mpuChartData.datasets[1].data.shift();
        mpuChartData.datasets[2].data.shift(); 
    }
    mpuChartData.labels.push(0);
    mpuChartData.datasets[0].data.push(x);
    mpuChartData.datasets[1].data.push(y);
    mpuChartData.datasets[2].data.push(z); 
    mpuGraphChart.update();

    $(knobX).val(`${x}%`); 
    $(knobY).val(`${y}%`); 
    $(knobZ).val(`${z}%`); 
    $('.knob').trigger('change');
}

// Chart EMG
var emgMaxData = 30;
var emgChartCanvas = $('#emg-canvas').get(0).getContext('2d');
var emgChartData = { 
    labels: [
        0
    ],
    datasets: [
        {
            label: 'Sudut X',
            'fill': false,
            borderWidth: 2,
            lineTension: 0,
            spanGaps: true,
            borderColor: '#cc3939',
            pointBackgroundColor: '#cc3939',
            data: [3] 
        },
    ]
}
var emgChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
        display: false
    },
    interaction: {
        mode: 'index',
        intersect: false,
    },
    scales: {
        xAxes: [{
            ticks: {
                fontColor: '#efefef'
            },
            gridLines: {
                display: false,
                color: '#efefef',
                drawBorder: false
            }
        }],
        yAxes: [{
            ticks: {
            stepSize: 1000,
                fontColor: '#efefef'
            },
            gridLines: {
                display: true,
                color: '#efefef',
                drawBorder: false
            }
        }]
    }

}
var emgGraphChart = new Chart(
    emgChartCanvas,
    {
        type: 'line',
        data: emgChartData,
        options: emgChartOptions
    }
)

function addDataEMG({emg_ma}) {
    emg = emg_ma; 
    
    if(emgGraphChart.data.labels.length>=emgMaxData){
        emgGraphChart.data.labels.shift();
        emgGraphChart.data.datasets.forEach((dataset) => {
            dataset.data.shift();
        }); 
    }
    emgGraphChart.data.labels.push(0);
    emgGraphChart.data.datasets.forEach((dataset) => {
        dataset.data.push(emg);
    });

    emgGraphChart.update();
}
