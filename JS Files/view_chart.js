$(document).ready(function () {
    $.ajax({
        url: "create_data.php",
        type: "GET",
        success: function (data) {
            var date_time = [];
            var value = [];
            for (var i in data) {
                date_time.push("" + data[i].date_time);
                value.push(data[i].value);
            }

            var chartdata = {
                labels: date_time,
                datasets: [
                    {
                        label: "value",
                        fill: false,
                        lineTension: 0.3,
                        backgroundColor: chartColors.green,
                        borderColor: chartColors.green,
                        pointHoverBackgroundColor: chartColors.green,
                        pointHoverBorderColor: chartColors.green,
                        hoverBackgroundColor: chartColors.gold,
                        data: value,
                        yAxisID: "y-axis-1"
                    }
                ]
            };

            var ctx = $("#value-data");

            var LineGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                    title: {
                        display: true,
                        text: '',
                        maintainAspectRatio: false,
                        fontColor: chartColors.green
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: ''
                            }
                        }],
                        yAxes: [{
                            type: "linear",
                            display: true,
                            position: "left",
                            id: "y-axis-1",
                            scaleLabel: {
                                display: false,
                                labelString: 'value'
                            }
                        }]
                    }
                }
            });
        },
        error: function (data) {

        }
    });
});
window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    gold: 'rgb(248,193,28)',
    grey: 'rgb(201, 203, 207)'
};