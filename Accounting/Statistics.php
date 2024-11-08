<?php
require('../Database/statistics.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Style/Statistic_Accounting.css">
</head>
<body>

<div class="container">
    <div class="left_side">
        <div class="top">
            <div class="verification_count">
                <h3>Payment Verified</h3>
                <p class="count"><?php echo $totalDataStat; ?></p>
            </div>
        </div>
        <div class="bottom">
            <div class="payment_count">
                <h3>Number Of Payment</h3>
                <p class="count"><?php echo $totalData; ?></p>
            </div>
        </div>
    </div>
    <div class="right_side">
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
    </div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>

Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Payment Distribution',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    accessibility: {
        point: {
            valueSuffix: ''
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Payment Status',
        colorByPoint: true,
        data: [
            { name: 'Verified', y: <?php echo $totalDataStat; ?> }, 
            { name: 'Total', y: <?php echo $totalData; ?> } 
        ]
    }]
});
</script>

</body>
</html>
