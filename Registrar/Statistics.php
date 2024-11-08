<?php
require('../Database/statistics.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Style/Statistics_Registrar.css">
</head>
<body>

<div class="container">
    <div class="left-side">
        <figure class="highcharts-figure">
        <div id="container"></div>
        </figure>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
   
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Student Admission Year Level'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Number of Student'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
            '<b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: 'Student Year Level',
            colorByPoint: true,
            data: [
                { name: 'Grade 11', y: <?php echo $totalG11; ?> }, 
                { name: 'Grade 12', y: <?php echo $totalG12; ?> },
                { name: '1st Year', y: <?php echo $totalC1; ?> }, 
                { name: '2nd Year', y: <?php echo $totalC2; ?> }, 
                { name: '3rd Year', y: <?php echo $totalC3; ?> }, 
                { name: '4th Year', y: <?php echo $totalC4; ?> } 
            ]
        }
    ],
    
});

</script>


</body>
</html>
