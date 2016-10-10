<?php
include ('connect.php');

$moisture = $_REQUEST['moisture'];
$humidity = $_REQUEST['humidity'];
$temp = $_REQUEST['temp'];
$light = $_REQUEST['light'];
$field = $_REQUEST['field'];
$irrigator=$_REQUEST['irrigator'];
$moisture2=$_REQUEST['moisture2'];
//echo $moisture.'and '.$humidity.' and '.$light;
$conn = sqlsrv_connect($serverName, $connectionOptions) or die (FormatErrors());

$tsql = "INSERT INTO dbo.sensorData(field,moisture,humidity,temp,light,irrigator,timestamp,moisture2) VALUES('$field','$moisture','$humidity','$temp','$light','$irrigator',GETDATE(),'$moisture2')";
        //Insert query
$insertReview = sqlsrv_query($conn, $tsql) or die(FormatErrors());
echo 'OK';	
 sqlsrv_free_stmt($insertReview);
 sqlsrv_close($conn);

?>