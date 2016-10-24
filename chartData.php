<?php
header("Content-type: text/json");
// Include the connect.php file
include ('connect.php');

// get data and store in a json array
// $pagenum = $_GET['pagenum'];
// $pagesize = $_GET['pagesize'];
// $start = $pagenum * $pagesize;

try {
    $conn = mysqli_connect($serverName, $userName, $password, $database);
    //echo "Connected successfully"; 
    }
catch(EXCEPTION $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


$tsql = "SELECT id, field ,moisture ,humidity ,temp ,light ,irrigator,moisture2 ,fieldTimestamp FROM sensorData ORDER BY id DESC ";

// $totalRowsQ = mysqli_query($conn, "SELECT COUNT(*) AS count FROM dbo.sensorData") or die(FormatErrors());
$getProducts = mysqli_query($conn, $tsql) or die(FormatErrors());
$totalRows = mysqli_num_rows($getProducts);

// while($row = mysqli_fetch_array($totalRowsQ, MYSQLI_ASSOC))
// {
// 	$totalRows=$row['count'];
// }
$productCount = 0;
$moisture1P=array();
while($row = mysqli_fetch_array($getProducts, MYSQLI_ASSOC))
{
	$timest =strtotime(date_format(date_create($row['fieldTimestamp']),"Y/m/d H:i:s"));
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

//mysqli_free_stmt($getProducts);
mysqli_close($conn);

//echo json_encode($test);
?>
