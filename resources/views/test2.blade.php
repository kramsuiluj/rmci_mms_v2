<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
<body>

<div class="w-4/5 mx-auto">
    <canvas id="myChart"></canvas>
</div>

<script>
    let myChart = document.getElementById('myChart').getContext('2d');

    let barChart = new Chart(myChart, {
       type: 'doughnut',
       data: {
           labels: [],
           datasets: [{
               label: 'Modules',
               data: [
                   // '20'
               ],
               borderWidth: 1
           }]
       },
        // options: {
        //    scales: {
        //        xAxis: [],
        //        yAxis: [{
        //            ticks: {
        //                beginAtZero: true
        //            }
        //        }]
        //    }
        // }
    });

    var updateChart = function () {
        $.ajax({
            url: @json( route('api.chart') ),
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data[0]);
                barChart.data.labels = ['Submitted Modules', 'Number of Students'];
                barChart.data.datasets.forEach((dataset) => {
                    dataset.data.push(data[0]);
                    dataset.data.push(data[1]);
                })
                barChart.update();
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    updateChart();
    setInterval(() => {
        updateChart();
    }, 1000);
</script>

</body>
</html>
