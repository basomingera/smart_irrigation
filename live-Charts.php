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
<script src="js/themes/themes/gray.js"></script>

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
                <a href="#" onclick="showDialog('dialog')" class="#">Help</a>
           
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
                  
                    <h5 class="align-center bg-grayLighter fg-emerald">Field 1 Status: <i id="status1">yoo</i> </h5>
                    <h5 class="align-center bg-grayLighter fg-brown">Field 2 Status: <i  id="status2">yoo2</i> </h5>
                    
                     <hr class="thin bg-grayLighter">
				   	<div id="chartContainer" style="height: 500px; width: 100%;"></div>
				   
                    <hr class="thin bg-grayLighter">
                </div>
            </div>
        </div>
    </div>
    <footer>&copy Audace</footer>
    <!-- dialog data-windows-style="true"  -->
  <div data-role="dialog" id="dialog" class="padding20" data-windows-style="true"  data-close-button="true" style="font-size:10px;overflow-y:scroll;">
        <h4>Data Interpretation</h4>
        <p>
            <table class="table striped hovered cell-hovered border bordered">
                <tr>
                    <th>Parameter</th>
                    <th>Value Range</th>
                    <th>Interpretation</th>
                </tr>
                <tr>
                    <th>Field 1 Moisture</td>
                    <td>
                        <p>Over 660</p>
                        <p>Between 615 and 660</p>
                        <p>Between 410 and 615</p>
                        <p>Between 250 and 410</p>
                        <p>Between 0 and 250</p>
                    </td>
                    <td>
                        <p>High wet</p>
                        <p>Wet</p>
                        <p>Moderate wet</p>
                        <p>Dry</p>
                        <p>Very dry</p>
                    </td>
                </tr>
                <tr>
                    <th>Field 2 Moisture</td>
                      <td>
                        <p>Over 660</p>
                        <p>Between 615 and 660</p>
                        <p>Between 410 and 615</p>
                        <p>Between 250 and 410</p>
                        <p>Between 0 and 250</p>
                    </td>
                    <td>
                        <p>High wet</p>
                        <p>Hight wet</p>
                        <p>Wet</p>
                        <p>Moderate wet</p>
                        <p>Dry</p>
                    </td>
                </tr>
                <tr>
                    <th>Irrigator</td>
                    <td>
                        <p>0</p>
                        <p>1</p>
                    </td>
                    <td>
                        <p>OFF</p>
                        <p>ON</p>
                    </td>
                </tr>
                <tr>
                    <th>Temperature</td>
                    <td></td>
                    <td>Degree celisius</td>
                </tr>
                <tr>
                    <th>Humidity</td>
                    <td></td>
                    <td>Humidity in %</td>
                </tr>
                <tr>
                    <th>Light</td>
                    <td>
                        <p>Between 0 and 500</p>
                        <p>Between 0 and 500</p>
                    </td>
                    <td>
                        <p>Day</p>
                        <p>Night</p>
                    </td>
                </tr>
            </table>
        </p>
  </div>
</body>
</html>
<script>
    //dialog
function showDialog(id){
    var dialog = $("#"+id).data('dialog');
    if (!dialog.element.data('opened')) {
        dialog.open();
    } else {
        dialog.close();
    }
}
 var chart;
 /**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
function requestData() {
    $.ajax({
        url: 'live-Data.php',
        success: function(point) {
          // update status
          $("#status1").text(point.status);
          $("#status2").text(point.status2);
          
            var series1 = chart.series[0],
                shift = series1.data.length > 20; // shift if the series is longer than 20
           // var series2 = chart.series[1],
          //      shift = series2.data.length > 20;
            // add the point
            chart.series[0].addPoint(point.moisture1, true, shift);
            chart.series[1].addPoint(point.moisture2, true, shift);
            chart.series[2].addPoint(point.temp, true, shift);
            chart.series[3].addPoint(point.humidity, true, shift);
            chart.series[4].addPoint(point.light, true, shift);
            chart.series[5].addPoint(point.irrigator, true, shift);
            // call it again after one second
            setTimeout(requestData, 1000);    
        },
        cache: false
    });
}
 $(function () {
     
       chart = new Highcharts.Chart({
        chart: {
            renderTo: 'chartContainer',
            defaultSeriesType: 'line',
            events: {
                load: requestData
            }
        },
        title: {
            text: 'Live Sensor data',
              x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
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
            }]
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
        plotOptions: {
           line: {
                dataLabels: {
                    enabled: true
                },
               // enableMouseTracking: false
            }
        },
        series: [{
            name: 'Field1 Moisture',
            data: []
        },{
            name: 'Field2 Moisture',
            data: []
        },{
            name: 'Temperature',
            data: []
        },{
            name: 'Humidity',
            data: []
        },{
            name: 'Light',
            data: []
        },{
            name: 'Irrigator',
            data: []
        }
        ]
    });        
    
      
});
</script>
