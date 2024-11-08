<?php
require('./Database/statistics.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Style/Statistics_SuperAdmin.css">
</head>
<body>

    <div class="container">
        <div class="top">
            <div class="left_bot">
                <figure class="highcharts-figure">
                    <div id="container1"></div>
                </figure>
            </div>
            <div class="right_t">
                <figure class="highcharts-figure">
                    <div id="container2"></div>
                </figure>
            </div>
        </div>
        <div class="bot">
            <div class="left_top">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
        </div>
        <!-- <div class="left">
            <div class="left_bot">
                <figure class="highcharts-figure">
                    <div id="container1"></div>
                </figure>
            </div>
            <div class="left_top">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
        </div>
        <div class="right">
            <div class="right_t">
                <figure class="highcharts-figure">
                    <div id="container2"></div>
                </figure>
            </div> -->
        </div>
        
    </div>

<!--USer Type-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/item-series.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


    
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
            text: 'Total Number of Students'
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

<!--PIE CHART ACCOUNTING--> 

<script>

Highcharts.chart('container1', {
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

<!--USER TYPE-->



<script>
Highcharts.chart('container2', {

chart: {
    type: 'item'
},

title: {
    text: 'Distribution of Account'
},

legend: {
    labelFormat: '{name} <span style="opacity: 0.4">{y}</span>'
},

series: [{
    name: 'Representatives',
    keys: ['name', 'y', 'color', 'label'],
    data: [
        ['Super Admin', <?php echo $totalSuper; ?>, '#CC0099', 'Super Admin'],
        ['Accounting', <?php echo $totalAccounting; ?>, '#EE0011', 'Accounting'],
        ['Registrar', <?php echo $totalRegsitrar; ?>, '#448833', 'Registrar'],
        ['Professor', <?php echo $totalProf; ?>, '#FFCC00', 'Professor'],
        ['Student', <?php echo $totalStudent; ?>, '#000000', 'Student']
    ],
    dataLabels: {
        enabled: true,
        format: '{point.label}',
        style: {
            textOutline: '3px contrast'
        }
    },

   
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 600
        },
        chartOptions: {
            series: [{
                dataLabels: {
                    distance: -30
                }
            }]
        }
    }]
}
});

</script>


</body>
</html>