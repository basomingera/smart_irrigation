<?php
	
	// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied by 1000.
$x = time() * 1000;
// The y value is a random number
$y = rand(0, 100);

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
//echo json_encode($ret);

include ('connect.php');

// get data and store in a json array
$pagenum = $_GET['pagenum'];
$pagesize = $_GET['pagesize'];
$start = $pagenum * $pagesize;

try {
    $conn = mysqli_connect($serverName, $userName, $password, $database);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

 $tsql = "SELECT id, field ,moisture ,humidity ,temp ,light ,irrigator,moisture2 ,fieldTimestamp FROM sensorData ORDER BY id DESC Limit 1";
//echo $tsql;
// $totalRowsQ = mysqli_query($conn, "SELECT COUNT(*) AS count FROM sensorData") or die(FormatErrors());
$getProducts = mysqli_query($conn, $tsql);// or die(FormatErrors());
$totalRowsQ = mysqli_num_rows($getProducts);
$totalRows=$totalRowsQ;

// while($row = mysqli_fetch_array($totalRowsQ, mysqli_FETCH_ASSOC))
// {
// 	$totalRows=$row['count'];
// }
$productCount = 0;
while($row = mysqli_fetch_array($getProducts, MYSQLI_ASSOC))
{
	$glM1=(int)trim($row['moisture']);
	$glM2=(int)trim($row['moisture2']);
	$moisture1 = array(
		//'id'=>$row['id'],
		//'field'=>$row['field'],
		//'y' => $row['moisture'],
		//time($row['timestamp'],"Y/m/d H:i:s") ,
		$x,
		(int)trim($row['moisture'])

		//'humidity' => $row['humidity'],
		//'temp' => $row['temp'],
		//'light' => $row['light'],
		//'irrigator' => $row['irrigator'],
		//'x' => date_format($row['timestamp'],"Y/m/d H:i:s") 
	);
	$moisture2 = array(
		$x,
		(int)trim($row['moisture2'])
	);
	$humidity = array(
		$x,
		(int)trim($row['humidity'])
	);
	$temp = array(
		$x,
		(int)trim($row['temp'])
	);
	$irrigator = array(
		$x,
		(int)trim($row['irrigator'] == "on"?"1":"0")
	);
	$light = array(
		$x,
		(int)trim($row['light'])
	);
	
    $productCount++;
}

$data = array(
	'moisture1'=>$moisture1,
	'moisture2'=>$moisture2,
	'humidity'=>$humidity,
	'temp'=>$temp,
	'light'=>$light,
	'irrigator'=>$irrigator,
	'status'=>getStatus($glM1,""),
	'status2'=>getStatus($glM2,"field2")
);

//mysqli_free_stmt($getProducts);
mysqli_close($conn);

//function to determine the status
function getStatus($value,$type){
	//build the status
  if((int)$value >=660){
	 if($type=="field2"){ return("High Wet"); }
   	 return("High wet");
  }
  else if((int)$value >=615 && (int)$value<660){
	  if($type=="field2"){ return("High Wet"); }
     return("Wet");
  }
   else if((int)$value >=410 && (int)$value<615){
	 if($type=="field2"){ return("Wet"); }
   	 return("Moderate wet");
  }
   else if((int)$value >=250 && (int)$value<410){
	 if($type=="field2"){ return("Moderate Wet"); }
     return("Dry");
  }
   else if((int)$value >=0 && (int)$value<250){
	if($type=="field2"){ return("Dry"); }
    return("Very Dry");
  }
}
//echo json_encode($ret);
//echo json_encode($moisture1);
echo json_encode($data);
