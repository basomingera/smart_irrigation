<?php
header("Content-type: text/json");
// Include the connect.php file
include ('connect.php');

// get data and store in a json array
$pagenum = $_GET['pagenum'];
$pagesize = $_GET['pagesize'];
$start = $pagenum * $pagesize;

$conn = sqlsrv_connect($serverName, $connectionOptions) or die (FormatErrors());
$tsql = "SELECT Id, field ,moisture ,humidity ,temp ,light ,irrigator,moisture2 ,timestamp FROM dbo.sensorData ORDER BY Id DESC ";

$totalRowsQ = sqlsrv_query($conn, "SELECT COUNT(*) AS count FROM dbo.sensorData") or die(FormatErrors());
$getProducts = sqlsrv_query($conn, $tsql) or die(FormatErrors());

while($row = sqlsrv_fetch_array($totalRowsQ, SQLSRV_FETCH_ASSOC))
{
	$totalRows=$row['count'];
}
$productCount = 0;
$moisture1P=array();
while($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC))
{
	$timest =strtotime(date_format($row['timestamp'],"Y/m/d H:i:s"));
	$timest *=1000;
	$moi=(int)trim($row['moisture']);
	$moi2=(int)trim($row['moisture2']);
	$hum=(int)trim($row['humidity']);
	$tem=(int)trim($row['temp']);
	$irr=(int)trim($row['irrigator'] == "on"?"1":"0");
	$lig=(int)trim($row['light']);
	
	$moisture1[]="[$timest,$moi]";
	$moisture2[]="[$timest,$moi2]";
	$humidity[]="[$timest,$hum]";
	$temp[]="[$timest,$tem]";
	$irrigator[]="[$timest,$irr]";
	$light[]="[$timest,$lig]";
	
    $productCount++;
}

$data = array(
	'moisture1'=>$moisture1P,
	'moisture2'=>$moisture2,
	'humidity'=>$humidity,
	'temp'=>$temp,
	'light'=>$light,
	'irrigator'=>$irrigator,
);

sqlsrv_free_stmt($getProducts);
sqlsrv_close($conn);

//echo json_encode($test);
?>