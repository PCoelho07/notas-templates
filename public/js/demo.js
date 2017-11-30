if(!!(window.addEventListener)) window.addEventListener('DOMContentLoaded', main);
else window.attachEvent('onload', main);

function main() {
    lineChart();
    doughnutChart();
	doughnutChart2();
}

function lineChart() {
    var data = {
        labels : ["0","5","10","15","20","25","30"],
        datasets : [
            {
            fillColor : "rgba(71,229,193,1)",
            strokeColor : "rgba(71,229,193,1)",
            pointColor : "rgba(71,229,193,1)",
            pointStrokeColor : "#fff",
            data : [2.5,3.5,3,2,4.2,3,4.5],
            label : ''
        },
        {
            fillColor : "rgba(69,81,97,1)",
            strokeColor : "rgba(69,81,97,1)",
            pointColor : "rgba(69,81,97,1)",
            pointStrokeColor : "#fff",
            data : [1.8,3,2.5,4,3,2,2.5],
            label : ''
        }
        ]
    };

    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx).Line(data);

}

function doughnutChart() {
    var data = [
        {
            value: 40,
            color:"#50e3c2",
            label: 'Animals'
        },
        {
            value : 60,
            color : "#edf3f6",
            label: 'People'
        },
    ];

    var ctx = document.getElementById("doughnutChart").getContext("2d");
    var doughnutChart = new Chart(ctx).Doughnut(data);

}

function doughnutChart2() {
    var data = [
        {
            value: 80,
            color:"#455161",
            label: 'Animals'
        },
        {
            value : 20,
            color : "#edf3f6",
            label: 'People'
        },
    ];

    var ctx = document.getElementById("doughnutChart2").getContext("2d");
    var doughnutChart2 = new Chart(ctx).Doughnut(data);

}
