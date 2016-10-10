<?php
//OpenConnection();	
InsertData();
function OpenConnection()
{
	try
    {
        $serverName = "tcp:ou2epileg9.database.windows.net,1433";
        $connectionOptions = array("Database"=>"audace_db",
            "Uid"=>"audace", "PWD"=>"UrakomeyeMana11!");
        $conn = sqlsrv_connect($serverName, $connectionOptions) or die (FormatErrors());
       // if($conn == false)
           //die(FormatErrors(sqlsrv_errors()));
		//   echo FormatErrors();
		//else{
			//echo "Yes connected!";
		//}
    }
    catch(Exception $e)
    {
        echo("Error!");
    }
}

function ReadData()
{
    try
    {
        $conn = OpenConnection();
        $tsql = "SELECT [CompanyName] FROM SalesLT.Customer";
        $getProducts = sqlsrv_query($conn, $tsql);
        if ($getProducts == FALSE)
            die(FormatErrors(sqlsrv_errors()));
        $productCount = 0;
        while($row = sqlsrv_fetch_array($getProducts, SQLSRV_FETCH_ASSOC))
        {
            echo($row['CompanyName']);
            echo("<br/>");
            $productCount++;
        }
        sqlsrv_free_stmt($getProducts);
        sqlsrv_close($conn);
    }
    catch(Exception $e)
    {
        echo("Error!");
    }
}

function InsertData()
{
    try
    {
       // $conn = OpenConnection();
 		$serverName = "tcp:ou2epileg9.database.windows.net,1433";
        $connectionOptions = array("Database"=>"audace_db",
            "Uid"=>"audace", "PWD"=>"UrakomeyeMana11!");
        $conn = sqlsrv_connect($serverName, $connectionOptions) or die (FormatErrors());
		
        $tsql = "INSERT INTO dbo.sensorData(field,moisture,humidity,temp,light,irrigator) VALUES('field1','450','500','25','780','on')";
        //Insert query
       $insertReview = sqlsrv_query($conn, $tsql) or die(FormatErrors());
	
       sqlsrv_free_stmt($insertReview);
        sqlsrv_close($conn);
    }
    catch(Exception $e)
    {
        echo("Error!");
    }
}

function FormatErrors(){
	if( ($errors = sqlsrv_errors() ) != null)
		      {
		         foreach( $errors as $error)
		         {
		            echo "SQLSTATE: ".$error[ 'SQLSTATE']."\n";
		            echo "code: ".$error[ 'code']."\n";
		            echo "message: ".$error[ 'message']."\n";
		         }
		      }
}
?>