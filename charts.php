<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="Audace Byishimo">

    <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />

    <title>Smart irrigation</title>

    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    	<!--Script Reference-->
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/metro.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


    <style>
        html, body {
            height: 100%;
        }

        body {
        }

        .page-content {
            padding-top: 2.125rem;
            min-height: 100%;
            height: 100%;
        }

        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }

        @media screen and (max-width: 800px) {
            #cell-sidebar {
                flex-basis: 52px;
            }

            #cell-content {
                flex-basis: calc(100% - 52px);
            }
        }
    </style>
</head>
<body class="bg-steel">
    <div class="app-bar fixed-top darcula" data-role="appbar">
        <a class="app-bar-element branding">Smart Irrigation</a>
        <span class="app-bar-divider"></span>
        <ul class="app-bar-menu">
            <li><a href="index.html">Sensor Data</a></li>
            <li>
                <a href="" class="dropdown-toggle">Analytics</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="charts.php">Charts</a></li>
                    <li><a href="live-Charts.php">Live Charts</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="#">Help</a>
            </li>
        </ul>
        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-cog"></span>Welcome</span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
               
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <div class="cell size-x200" id="cell-sidebar" style="background-color: #71b1d1; height: 100%">
                    <ul class="sidebar" style="padding-top:20px !important;">
                        <li>
                            <a href="#">
                                <span class="mif-apps icon"></span>
                                <span class="title">Sensor Data</span>
                                <span class="counter">0</span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
                <div class="cell auto-size padding20 bg-white" id="cell-content">
                  
                    <hr class="thin bg-grayLighter">
                   
				   	<div id="chartContainer" style="height: 500px; width: 100%;"></div>
				   
                    <hr class="thin bg-grayLighter">
                </div>
            </div>
        </div>
    </div>
    <footer>&copy Audace</footer>
</body>
</html>
<script>
 var chart;
 /**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
function requestData() {
    $.ajax({
        url: 'chartData.php',
        success: function(points) {
           // $.each(points.moisture1,function(i, item){
           //   chart.series[0].data=points.moisture1;
           // })
             
      // return false;
          //  alert(point[0].moisture1);
            // add the point

          //  chart.series[1].addPoint(point.moisture2, true, shift);
         //   chart.series[2].addPoint(point.temp, true, shift);
          //  chart.series[3].addPoint(point.humidity, true, shift);
         //   chart.series[4].addPoint(point.light, true, shift);
         //   chart.series[5].addPoint(point.irrigator, true, shift);
        
        },
        cache: false
    });
}
 $(function () {
     
       chart = new Highcharts.Chart({
        chart: {
            renderTo: 'chartContainer',
            defaultSeriesType: 'spline',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Daily Sensor data charts',
              x: -20 //center
        },
        subtitle: {
            text: 'Common Parameters',
            x: -20
        },
        xAxis: {
            type: 'datetime',
           // tickPixelInterval: 150,
           // tickInterval: 3600 * 1000,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Value',
                margin: 80
            },
             plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
        
        },
         tooltip: {
            valueSuffix: ''
        },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        
        <?php 
            include 'chartData.php';
            ?>
        series: [{
           // pointInterval:  3600 * 1000,
          //  pointStart: Date.UTC(2016, 5, 01, 0, 0, 0, 0),
            name: 'Field1 Moisture',
             data: [<?php echo join($moisture1, ',') ?>]
        },{
            name: 'Field2 Moisture',
            data: [<?php echo join($moisture2, ',') ?>]
        },{
            name: 'Temperature',
            data: [<?php echo join($temp, ',') ?>]
        },{
            name: 'Humidity',
            data: [<?php echo join($humidity, ',') ?>]
        },{
            name: 'Light',
            data: [<?php echo join($light, ',') ?>]
        },{
            name: 'Irrigator',
            data: [<?php echo join($irrigator, ',') ?>]
        }
        ]
    });        
    
   //   requestData();
});
</script>
