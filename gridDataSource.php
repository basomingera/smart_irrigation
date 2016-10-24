<?php
// Include the connect.php file
include ('connect.php');

// get data and store in a json array
$pagenum = $_GET['pagenum'];
$pagesize = $_GET['pagesize'];
$start = $pagenum * $pagesize;


try {
    $conn = mysqli_connect($serverName, $userName, $password, $database);
    //echo "Connected successfully"; 
    }
catch(Exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$tsql = "SELECT id, field ,moisture ,humidity ,temp ,light ,irrigator,moisture2 ,fieldTimestamp FROM sensorData ORDER BY id DESC LIMIT 100";//. //$pagesize  ." OFFSET ". $start;

//echo $tsql;
//echo $tsql;
//$totalRowsQ = mysqli_query($conn, "SELECT COUNT(*) AS count FROM sensorData") or die(FormatErrors());

$getProducts = mysqli_query($conn, $tsql);// or die(FormatErrors());
$totalRowsQ = mysqli_num_rows($getProducts);
$totalRows=$totalRowsQ;
// while($row = mysqli_fetch_array($getProducts, MYSQLI_ASSOC))
// {

// 	$totalRows=mysqli_num_rows($getProducts);
// 	echo $totalRows;
// }

$productCount = 0;

while($row = mysqli_fetch_array($getProducts, MYSQLI_ASSOC))
{
	$customers[] = array(
		'id'=>$row['id'],
		'field'=>$row['field'],
		'moisture' => $row['moisture'],
		'moisture2' => $row['moisture2'],
		'humidity' => $row['humidity'],
		'temp' => $row['temp'],
		'light' => $row['light'],
		'irrigator' => $row['irrigator'],
		'fieldTimestamp' => date_format(date_create($row['fieldTimestamp']),"Y/m/d H:i:s") 
	);
    $productCount++;
}

$data[] = array(
	'TotalRows' => $totalRows,
	'Rows' => $customers
);
echo json_encode($data);

//sqlsrv_free_stmt($getProducts);
mysqli_close($conn);
?>
