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
try {
    $conn = mysqli_connect($serverName, $userName, $password, $database);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$timeStamp= date("Y-m-d h-m-s");
$tsql = "INSERT INTO sensorData(field,moisture,humidity,temp,light,irrigator,fieldTimestamp,moisture2) VALUES('$field','$moisture','$humidity','$temp','$light','$irrigator','$timeStamp','$moisture2')";
        //Insert query
$insertReview = mysqli_query($conn, $tsql) or die(FormatErrors());
echo 'OK';	
 mysqli_close($conn);

?>