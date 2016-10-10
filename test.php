<!DOCTYPE html>
<html>
<head>
<!--Script Reference-->
<script src="http://cdn.zingchart.com/zingchart.min.js"></script>
</head>
<body>
<!--Chart Placement-->
<div id ='chartDiv'></div>
<script>
  var chartData={
    "type":"bar",  // Specify your chart type here.
    "series":[  // Insert your series data here.
        { "values": [35, 42, 67, 89]},
        { "values": [28, 40, 39, 36]}
    ]
  };
  zingchart.render({ // Render Method
    id:'chartDiv',
    data:chartData,
    height:400,
    width:600
  });
</script>
</body>
</html>