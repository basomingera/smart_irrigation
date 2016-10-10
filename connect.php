<?php
# FileName="connect.php"
 $serverName = "http://172.29.49.228/";
$connectionOptions = array("Database"=>"smart_irrigation_db","Uid"=>"rob", "PWD"=>"--X+V=-Z6Jp@sY75");
 
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
