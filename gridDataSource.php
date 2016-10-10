<?php
// Include the connect.php file
include ('connect.php');

// get data and store in a json array
$pagenum = $_GET['pagenum'];
$pagesize = $_GET['pagesize'];
$start = $pagenum * $pagesize;

$conn = sqlsrv_connect($serverName, $connectionOptions) or die (FormatErrors());
$tsql = "SELECT Id, field ,moisture ,humidity ,temp ,light ,irrigator,moisture2 ,timestamp FROM dbo.sensorData ORDER BY Id DESC OFFSET  $start ROWS FETCH NEXT $pagesize ROWS ONLY ";

$totalRowsQ = sqlsrv_query($conn, "SELECT COUNT(*) AS count FROM dbo.sensorData") or die(FormatErrors());
$getProducts = sqlsrv_query($conn, $tsql) or die(FormatErrors());

while($row = sqlsrv_fetch_array($totalRowsQ, SQLSRV_FETCH_ASSOC))
{
	$totalRows=$row['count'];
}
$productCount = 0;
while($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC))
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
		'timestamp' => date_format($row['timestamp'],"Y/m/d H:i:s") 
	);
    $productCount++;
}

$data[] = array(
	'TotalRows' => $totalRows,
	'Rows' => $customers
);
echo json_encode($data);

sqlsrv_free_stmt($getProducts);
sqlsrv_close($conn);
?>